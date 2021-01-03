<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Film Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col justify-center items-center relative h-full ">
                        @if(count($userFilmProfile )>0)
                            @foreach($userFilmProfile as $profile)
                                @if($profile->image == null)
                                    <img
                                        src="https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png"
                                        class="h-28 w-28 object-cover rounded-full">
                                @else
                                    <img
                                        src="/storage/images/{{$profile->image->image}}"
                                        class="h-28 w-28 object-cover rounded-full">
                                @endif
                            @endforeach
                        @else
                            <img
                                src="https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png"
                                class="h-28 w-28 object-cover rounded-full">
                        @endif

                    </div>
                    @component('components.film-profile-card')
                        @if(count($userFilmProfile )>0)
                            @foreach($userFilmProfile as $profile)
                                <img
                                    src="&w=1050&q=80"
                                    class="https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png">
                                @slot('favFilm')
                                    {{$profile->favourite_film}}
                                @endslot
                                @slot('interests')
                                    {{$profile->interests}}
                                @endslot
                                @slot('reasoning')
                                    {{$profile->film_reasoning}}
                                @endslot
                            @endforeach
                        @else
                            <img
                                src="https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png"
                                class="h-24 w-24 object-cover rounded-full">
                            @slot('favFilm')
                            @endslot
                            @slot('interests')
                            @endslot
                            @slot('reasoning')
                            @endslot
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
