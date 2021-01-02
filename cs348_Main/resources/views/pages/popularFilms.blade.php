<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Popular Films') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-600 border-b border-gray-200">
                    @foreach($requestData as $upcomingFilm)
                        @component('components.tmdb-movie-card')
                            @slot('image')
                                {{$upcomingFilm->backdrop_path}}
                            @endslot
                            @slot('title')
                                {{$upcomingFilm->original_title}}
                            @endslot
                            @slot('overview')
                                {{$upcomingFilm->overview}}
                            @endslot
                            @slot('releaseDate')
                                {{$upcomingFilm->release_date}}
                            @endslot
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
