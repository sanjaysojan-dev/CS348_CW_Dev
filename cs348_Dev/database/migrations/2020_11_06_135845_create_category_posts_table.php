<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_posts', function (Blueprint $table) {
            $table->primary(['category_id', 'post_id']);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('post_id');

            $table->foreign('category_id')->references('id')->on('categories')
                ->cascadeOnUpdate('cascade')
                ->cascadeOnDelete('cascade');

            $table->foreign('post_id')->references('id')->on('posts')
                ->cascadeOnUpdate('cascade')
                ->cascadeOnDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_posts');
    }
}
