<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie Genres') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full mx-auto">
                        <div class="flex flex-col sm:flex-row h-auto">
                            @foreach($genres as $genre)
                                @component('components.genre-card')
                                    @slot('genre')
                                        {{$genre->description}}
                                    @endslot
                                        <a href="{{ route('showGenrePost',['id' => $genre->id])}}" class="px-4 py-2 bg-blue-500 text-white rounded-full">{{$genre->title}}</a>
                                @endcomponent
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
