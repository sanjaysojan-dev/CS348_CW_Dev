<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Comments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-600 border-b ">

                    @if(count($userComments)>0)
                        <div>
                            @foreach($userComments->sortByDesc('updated_at') as $comment)
                                <a class="text-black-600 font-semibold text-lg text-center md:text-left "
                                   href="{{ route('showPost',['id' => $comment->post->id])}}">Comment on
                                    Post: {{$comment->post->title}}</a>
                                @component('components.comment-card')
                                    @slot('commentCreator')
                                        {{$comment->user->name}}
                                    @endslot

                                    @slot('description')
                                        {{$comment->description}}
                                    @endslot
                                    @slot('commentDate')
                                        {{$comment->created_at}}
                                    @endslot
                                @endcomponent
                                <div class="flex items-center space-x-4 justify-end mt-4 top-auto">

                                    <a class="btn bg-blue-600 text-gray-200 px-2 py-2 rounded-md"
                                       href="{{ route('editComment',['id' => $comment->id])}}">Edit</a>
                                    <form action="{{route('deleteComment',['id'=>$comment->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" bg-red-500 text-gray-900 px-2 py-2 rounded-md mr-2"
                                                type="submit">Delete
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        You have not commented on any posts yet!
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
