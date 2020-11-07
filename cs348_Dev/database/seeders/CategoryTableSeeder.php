<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category;
        $category->id = 1;
        $category->title = "category_test";
        $category->description = "category_test";
        $category->save();

        Category::factory()
            ->times(2)
            ->create();
    }
}
