<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$post->title}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <br>
                    <h2 class="text-l text-gray-800 font-medium mr-auto">{{$post->description}}</h2>
                </div>

                @foreach($post->comments->sortByDesc('updated_at') as $comment)
                    @component('components.comment-card')
                        @slot('commentCreator')
                            {{$comment->user->name}}
                        @endslot
                            {{$comment->description}}
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
