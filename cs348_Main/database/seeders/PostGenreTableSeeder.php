<?php

namespace Database\Seeders;

use App\Models\PostGenre;
use Illuminate\Database\Seeder;

class PostGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostGenre::factory()
            ->times(2)
            ->create();
    }
}
