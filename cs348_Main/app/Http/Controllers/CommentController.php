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
        return view('pages.allUserComments', compact('userComments'));
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function apiIndex($id)
    {
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        return $comments;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function apiStore(Request $request)
    {
        $user = Auth::user();


            $validatedData = $request->validate([
                'description' => 'required',
            ]);


            $comment = new Comment;
            $comment->description = $validatedData['description'];
            $comment->user_id = $request['user_id'];
            $comment->post_id = $request['post_id'];
            $comment->save();

            $newComment = Comment::with(['user'])->where('id', $comment->id)->get();


            $post = Post::find($request['post_id']);
            $commentAuthor = User::find($comment->user_id);
            $user = User::find($post->user->id);
            $user->notify(new PostNotification('New comment by ' . $commentAuthor->name . " on Post " . $post->title));

            return $newComment;
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
        $comment = Comment::find($id);
        if ($user->can('update', $comment)) {
            return view('pages/editComment', compact('comment'));
        } else {
            return redirect()->route('allComments');
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
        $comment = Comment::find($id);

        if ($user->can('update', $comment)) {
            $validatedData = $request->validate([
                'description' => 'required',
            ]);

            $comment->description = $validatedData['description'];
            $comment->save();

            session()->flash('message', 'Comment was successfully updated!');
            return redirect()->route('allComments');
        } else {
            return redirect()->route('allComments');
        }
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
        $user = Auth::user();

        if ($user->can('delete', $comment)) {
            $comment->delete();
            session()->flash('message', 'Post was Deleted!');
            return redirect()->route('allComments');
        } else {
            session()->flash('message', "You don't have authentication");
            return redirect()->route('userPosts');
        }

    }
}
