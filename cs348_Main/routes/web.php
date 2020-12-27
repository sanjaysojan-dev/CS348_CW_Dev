<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/


Route::get('/', function () {
    return view('auth.register');
});

Route::get('allPosts', 'App\Http\Controllers\PostController@index')
    ->middleware(['auth'])->name('allPosts');

Route::get('userPosts', 'App\Http\Controllers\PostController@showUserPosts')
    ->middleware(['auth'])->name('userPosts');

Route::get('showPost/{id}', 'App\Http\Controllers\PostController@show')
    ->middleware(['auth'])->name('showPost');

Route::post('post', 'App\Http\Controllers\PostController@store')
    ->middleware(['auth'])->name('post');

Route::delete('deletePost/{id}', 'App\Http\Controllers\PostController@destroy')
    ->middleware(['auth'])->name('deletePost');



Route::get('editPost/{id}', 'App\Http\Controllers\PostController@edit')
    ->middleware(['auth'])->name('editPost');

Route::put('savePost/{id}', 'App\Http\Controllers\PostController@update')
    ->middleware(['auth'])->name('savePost');

Route::get('allComments', 'App\Http\Controllers\CommentController@index')
    ->middleware(['auth'])->name('allComments');



Route::delete('deleteComment/{id}', 'App\Http\Controllers\CommentController@destroy')
    ->middleware(['auth'])->name('deleteComment');

Route::get('editComment/{id}', 'App\Http\Controllers\CommentController@edit')
    ->middleware(['auth'])->name('editComment');

Route::put('saveComment/{id}', 'App\Http\Controllers\CommentController@update')
    ->middleware(['auth'])->name('saveComment');




Route::get('genres', 'App\Http\Controllers\GenreController@index')
    ->middleware(['auth'])->name('genres');

Route::get('showGenrePost/{id}', 'App\Http\Controllers\GenreController@show')
    ->middleware(['auth'])->name('showGenrePost');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
