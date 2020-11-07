<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat_post = new CategoryPost;
        $cat_post->post_id = 1;
        $cat_post->category_id = 1;
        $cat_post->save();

        CategoryPost::factory()
            ->times(2)
            ->create();
    }
}
