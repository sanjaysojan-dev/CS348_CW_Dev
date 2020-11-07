<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->id = 1;
        $post->title = "post_test";
        $post->description = "post_test";
        $post->user_id = 1;
        $post->save();

        Post::factory()
            ->times(5)
            ->create();
    }
}
