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

Route::get('/allPosts', 'App\Http\Controllers\PostController@index')
    ->middleware(['auth'])->name('allPosts');

Route::get('/userPosts', 'App\Http\Controllers\PostController@showUserPosts')
    ->middleware(['auth'])->name('userPosts');

Route::get('/showPost/{id}', 'App\Http\Controllers\PostController@show')
    ->middleware(['auth'])->name('showPost');

Route::post('post', 'App\Http\Controllers\PostController@store')
    ->middleware(['auth'])->name('post');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
