<?php

namespace App;
use Illuminate\Support\Facades\Http;

class TMDB {

    private $apiKey = '13940090e50ffcce1cfadc44221aff67';

    public function __construct(){

    }

    public function getUpcomingMovies (){
        $response = Http::get('https://api.themoviedb.org/3/movie/upcoming?',
        ['api_key' => $this->apiKey]);

        return $response;
    }


}
