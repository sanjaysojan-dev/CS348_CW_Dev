<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach($posts as $post)
                            <div class ="flex justify-center">

                                <li><a href="{{ route('showPost',['id' => $post->id])}}">{{$post->title}}</a></li>
                                @component('components.post-card')
                                    @slot('title')
                                        {{$post->title}}
                                    @endslot
                                        {{$post->description}}

                                    @slot('creator')
                                            {{$post->user->name}}
                                        @endslot
                                @endcomponent
                            </div>
                        @endforeach
                        <div class="flex justify-center">{{$posts ->links()}}</div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
