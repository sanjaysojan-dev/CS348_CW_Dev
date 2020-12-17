<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_genres', function (Blueprint $table) {
            $table->id('id');

            $table->foreignId('post_id')
                ->constrained('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('genre_id')
                ->constrained('genres')
                ->onDelete('cascade')
                ->onUpdate('cascade');


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
        Schema::dropIfExists('post_genres');
    }
}
