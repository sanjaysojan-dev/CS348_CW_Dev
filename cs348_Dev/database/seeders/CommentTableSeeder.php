<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment;
        $comment->id = 1;
        $comment->description = "comment_test";
        $comment->post_id = 1;
        $comment->user_id = 1;
        $comment->save();


        Comment::factory()
            ->times(5)
            ->create();
    }
}
