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
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        //dd($posts);
        return view('pages.allPosts', compact('posts'));
    }


    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showUserPosts()
    {
        $posts = User::find(Auth::user()->id)->posts;
        $genres = Genre::all();
        //dd($posts);
        return view('pages.userPosts', compact('posts', 'genres'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('pages/showPost', ['post' => $post]);
    }


    public function showUpcomingFilms (TMDB $TMDB) {
        //$requestData = json_decode ($TMDB->getUpcomingMovies())->results;
        $requestData = json_decode(app(TMDB::class)->getUpcomingMovies())->results;
        //dd($requestData);
        return view('pages.popularFilms', compact('requestData'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        //dd($user->can('create', Post::class));
        if ($user->can('create', Post::class)) {

            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'image_upload' => 'image|nullable| max:1999'
            ]);

            //dd($request);


            if ($request->hasFile('image_upload')) {
                $fullFileName = $request->file('image_upload')->getClientOriginalName();

                $filename = pathinfo($fullFileName, PATHINFO_FILENAME);
                $fileExtension = $request->file('image_upload')->getClientOriginalExtension();

                $fileNameToStore = $filename . '_' . time() . '.' . $fileExtension;
                $path = $request->file('image_upload')->storeAs('public/images', $fileNameToStore);

            } else {
                $fileNameToStore = 'noImageUploaded.jpg';
            }

            $image = new Image(['image' => $fileNameToStore]);

            $newPost = new Post();
            $newPost->title = $validatedData['title'];
            $newPost->description = $validatedData['description'];
            //$newPost->image = $fileNameToStore;
            $newPost->user_id = Auth::user()->id;
            $newPost->save();
            $newPost->image()->save($image);

            $genres = Genre::all();
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $genres = Genre::all();
        if ($user->can('update', $post)) {
            return view('pages/editPost', compact('post', 'genres'));
        } else {
            return redirect()->route('userPosts', );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        $updatedPost = Post::find($id);

        if ($user->can('update', $updatedPost)) {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'image_upload' => 'image|nullable| max:1999'
            ]);

            if ($request->hasFile('image_upload')) {
                $fullFileName = $request->file('image_upload')->getClientOriginalName();
                $filename = pathinfo($fullFileName, PATHINFO_FILENAME);
                $fileExtension = $request->file('image_upload')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $fileExtension;
            }


            $updatedPost->title = $validatedData['title'];
            $updatedPost->description = $validatedData['description'];


            if ($request->hasFile('image_upload')) {

                if ($updatedPost->image->image != 'noImageUploaded.jpg') {
                    unlink('storage/images/' . $updatedPost->image->image);
                }

                //$updatedPost->image =  $fileNameToStore;
                Image::where('imageable_type', 'App\Models\Post')->where('imageable_id', $updatedPost->id)->delete();
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $user = Auth::user();

        if ($user->can('delete', $post)) {
            //Storage::delete('storage/images/'.$post->image);
            if ($post->image->image != 'noImageUploaded.jpg') {
                unlink('storage/images/' . $post->image->image);
            }

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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminDestroy($id)
    {
        $post = Post::find($id);
        $user = Auth::user();

        if ($user->can('delete', $post)) {
            //Storage::delete('storage/images/'.$post->image);
            if ($post->image->image != 'noImageUploaded.jpg') {
                unlink('storage/images/' . $post->image->image);
            }

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
