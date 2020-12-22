<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(2);
        //dd($posts);
        return view('pages.allPosts', compact('posts'));
    }

    public function showUserPosts()
    {
        $posts = User::find(Auth::user()->id)->posts;
        //dd($posts);
        return view('pages.userPosts', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

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

            $fileNameToStore = $filename .'_' .time(). '.' . $fileExtension;
            $path = $request->file('image_upload')->storeAs('public/images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noImageUploaded.jpg';
        }

        $newPost = new Post();
        $newPost->title = $validatedData['title'];
        $newPost->description = $validatedData['description'];
        $newPost->image = $fileNameToStore;
        $newPost->user_id = Auth::user()->id;
        $newPost->save();

        session()->flash('message', 'Post was successfully created!');
        return redirect()->route('userPosts');
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

    public function showAllUserPosts()
    {
        $userPosts = User::find(Auth::user()->id)->posts();
        //dd(User::find(Auth::user()->id));
        return view('pages/userPosts', ['posts' => $userPosts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (Auth::user()->id != $post->user_id){
            session()->flash('message', "You don't have authentication");
            return redirect()->route('userPosts');
        }

        //Storage::delete('storage/images/'.$post->image);
        unlink('storage/images/'.$post->image);
        $post->delete();
        session()->flash('message', 'Post was Deleted!');
        return redirect()->route('userPosts');
    }
}
