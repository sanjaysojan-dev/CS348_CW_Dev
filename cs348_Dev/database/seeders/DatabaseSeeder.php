<?php

namespace Database\Seeders;

use Database\Factories\CategoryPostFactory;
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
            CategoryTableSeeder::class,
            CategoryPostTableSeeder::class
        ]);
    }
}
