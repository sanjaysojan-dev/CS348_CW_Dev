<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            PostTableSeeder::class,
            CommentTableSeeder::class,
            GenreTableSeeder::class,
            PostGenreTableSeeder::class,
            UserFilmProfileTableSeeder::class,
            ImageTableSeeder::class
        ]);

    }
}
