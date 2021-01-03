<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display all Genres
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $genres = Genre::all();
        return view('pages.allGenres', compact('genres'));
    }

    /**
     * Display all posts with genres
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allRelatedPosts = Genre::findOrFail($id)->posts;
        return view('pages.genrePosts', compact('allRelatedPosts'));
    }
}
