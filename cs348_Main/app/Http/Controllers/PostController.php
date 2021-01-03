<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Image;
use App\Models\Post;
use App\Models\PostGenre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TMDB;


class PostController extends Controller
{

    /**
     * Display all Post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('pages.allPosts', compact('posts'));
    }

    /**
     * Display all user specific Posts
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showUserPosts()
    {
        $posts = User::find(Auth::user()->id)->posts;
        $genres = Genre::all();

        return view('pages.userPosts', compact('posts', 'genres'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id selected Post ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('pages/showPost', ['post' => $post]);
    }

    /**
     * Method to return JSON response of Upcoming Films
     *
     * @param TMDB $TMDB
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function showUpcomingFilms(TMDB $TMDB)
    {
        $requestData = json_decode(app(TMDB::class)->getUpcomingMovies())->results;
        return view('pages.popularFilms', compact('requestData'));
    }


    /**
     * Store a newly create Post
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        //Checks for permission
        if ($user->can('create', Post::class)) {

            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'image_upload' => 'image|nullable| max:1999'
            ]);

            if ($request->hasFile('image_upload')) {
                //Full File Name
                $fullFileName = $request->file('image_upload')->getClientOriginalName();
                //File Name Only
                $filename = pathinfo($fullFileName, PATHINFO_FILENAME);
                $fileExtension = $request->file('image_upload')->getClientOriginalExtension();

                //New File Name
                $fileNameToStore = $filename . '_' . time() . '.' . $fileExtension;
                $request->file('image_upload')->storeAs('public/images', $fileNameToStore);

            } else {
                $fileNameToStore = 'noImageUploaded.jpg';
            }

            $image = new Image(['image' => $fileNameToStore]);

            //Creating new Post
            $newPost = new Post();
            $newPost->title = $validatedData['title'];
            $newPost->description = $validatedData['description'];
            $newPost->user_id = Auth::user()->id;
            $newPost->save();
            $newPost->image()->save($image);

            $genres = Genre::all();

            //Saving many to many relationship
            foreach ($genres as $genre) {
                if ($request->input($genre->title) != null) {
                    $postGenre = new PostGenre();
                    $postGenre->post_id = $newPost->id;
                    $postGenre->genre_id = $genre->id;
                    $postGenre->save();
                }
            }

            session()->flash('message', 'Post was successfully created!');
            return redirect()->route('userPosts');
        } else {
            return redirect()->route('userPosts');
        }

    }

    /**
     * Method to direct user to edit page
     *
     * @param int $id Post ID of selected ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $genres = Genre::all();

        //Checks for permission
        if ($user->can('update', $post)) {
            return view('pages.editPost', compact('post', 'genres'));
        } else {
            return redirect()->route('userPosts',);
        }
    }

    /**
     * Update the specified Post
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $updatedPost = Post::find($id);

        //Checks for permission
        if ($user->can('update', $updatedPost)) {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'image_upload' => 'image|nullable| max:1999'
            ]);

            $updatedPost->title = $validatedData['title'];
            $updatedPost->description = $validatedData['description'];

            if ($request->hasFile('image_upload')) {

                $fullFileName = $request->file('image_upload')->getClientOriginalName();
                $filename = pathinfo($fullFileName, PATHINFO_FILENAME);
                $fileExtension = $request->file('image_upload')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $fileExtension;

                if ($updatedPost->image->image != 'noImageUploaded.jpg') {
                    //Deleting image from folder
                    unlink('storage/images/' . $updatedPost->image->image);
                }

                //Deleting Image Reference
                Image::where('imageable_type', 'App\Models\Post')->where('imageable_id', $updatedPost->id)->delete();
                //Creating new Image Link
                $image = new Image(['image' => $fileNameToStore]);
                $updatedPost->image()->save($image);
                $request->file('image_upload')->storeAs('public/images', $fileNameToStore);
            }

            $updatedPost->user_id = Auth::user()->id;
            $updatedPost->save();

            session()->flash('message', 'Post was successfully updated!');
            return redirect()->route('userPosts');
        } else {
            return redirect()->route('userPosts');
        }
    }

    /**
     * Delete method for users
     *
     * @param $id ID of post to be deleted
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $user = Auth::user();

        //Checks for permission
        if ($user->can('delete', $post)) {
            if ($post->image->image != 'noImageUploaded.jpg') {
                unlink('storage/images/' . $post->image->image);
            }
            //Deleting Image Reference
            Image::where('imageable_type', 'App\Models\Post')->where('imageable_id', $post->id)->delete();
            $post->delete();
            session()->flash('message', 'Post was Deleted!');
            return redirect()->route('userPosts');
        } else {
            session()->flash('message', "You don't have authentication");
            return redirect()->route('userPosts');
        }
    }


    /**
     * Delete method for admins
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminDestroy($id)
    {
        $post = Post::find($id);
        $user = Auth::user();

        //Checks for permission
        if ($user->can('delete', $post)) {
            if ($post->image->image != 'noImageUploaded.jpg') {
                unlink('storage/images/' . $post->image->image);
            }
            //Deleting Image Reference
            Image::where('imageable_type', 'App\Models\Post')->where('imageable_id', $post->id)->delete();
            $post->delete();
            session()->flash('message', 'Post was Deleted!');
            return redirect()->route('allPosts');
        } else {
            session()->flash('message', "You don't have authentication");
            return redirect()->route('allPosts');
        }
    }
}
