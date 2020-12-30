<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NotificationController;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userComments = User::find(Auth::user()->id)->comments;
        $userComments->load('post');
        return view ('pages.allUserComments', compact('userComments'));
    }

    public function apiIndex($id)
    {
        $comments = Comment::with(['user'])->where('post_id',$id)->get();
        return $comments;
    }

    public function apiStore (Request $request){

        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        $comment = new Comment;
        $comment->description = $validatedData['description'];
        $comment->user_id = $request['user_id'];
        $comment->post_id = $request['post_id'];
        $comment->save();

        $newComment = Comment::with(['user'])->where('id',$comment->id)->get();


        $post = Post::find($request['post_id']);
        $commentAuthor = User::find($comment->user_id);
        $user = User::find($post->user->id);
        $user->notify(new PostNotification('New comment by '.$commentAuthor->name." on Post ".$post->title));


        return $newComment;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('pages/editComment', compact('comment'));
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
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        $comment = Comment::find($id);
        $comment->description = $validatedData['description'];
        $comment->save();

        session()->flash('message', 'Comment was successfully updated!');
        return redirect()->route('allComments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (Auth::user()->id != $comment->user_id) {
            session()->flash('message', "You don't have authentication");
            return redirect()->route('userPosts');
        }

        $comment->delete();
        session()->flash('message', 'Post was Deleted!');
        return redirect()->route('allComments');
    }
}
