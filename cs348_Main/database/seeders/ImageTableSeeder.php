<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::all()->each(function($post){
                Image::factory()->create(['imageable_id'=> $post->id, 'imageable_type' => Post::class]);
        });
    }
}
