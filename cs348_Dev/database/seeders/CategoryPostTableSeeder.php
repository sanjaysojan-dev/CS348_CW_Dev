<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
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
        CategoryPost::factory()
            ->times(4)
            ->create();
    }
}
