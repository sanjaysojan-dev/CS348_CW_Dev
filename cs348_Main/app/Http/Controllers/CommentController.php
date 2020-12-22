<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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
        //
    }

    public function apiIndex($id)
    {

        $comments = Comment::with(['user'])->where('post_id',$id)->get();
        return $comments;
    }

    public function apiGetCommentCreator($id){
        $comments = Post::findOrFail($id)->comments;

        $users = array();
        foreach ($comments as $comment) {
            array_push($users,$comment->user);
        }
        return $users;
    }

    public function apiStore (Request $request){

        $comment = new Comment;
        $comment->description = $request['description'];
        $comment->user_id = $request['user_id'];
        $comment->post_id = $request['post_id'];
        $comment->save();

        $newComment = Comment::with(['user'])->where('id',$comment->id)->get();

        return $comment;
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
    public function destroy($id)
    {
        //
    }
}
