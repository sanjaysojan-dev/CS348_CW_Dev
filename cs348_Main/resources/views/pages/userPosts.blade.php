<x-app-layout>

    <style>
        #container {
            display: table;
            width: 100%;
            background: #7a7575;
        }

        #container > div {
            display: table-cell;
            padding: 1em;
            word-wrap: break-word;
            height: auto;
            width: 60%;
            float: left;
        }

        #container > div:nth-child(2) {
            width: 40%;
            padding-top: 60px;
            padding-right: 30px;
            height: auto;
            background: #7a7575;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class=" p-6 bg-gray-400 border-b border-gray-200">
                    <div id="container">
                        <div class="relative flex mx-auto  justify-center">

                            @component('components/post-form')
                                @foreach($genres as $genre)
                                    {{$genre->title}}
                                    <input class="form-check-input" type="checkbox" name="{{$genre->title}}">
                                @endforeach
                            @endcomponent
                            <br style="clear: both">
                        </div>
                        <div class=" flex mx-auto  justify-center">
                            <img class="h-80 w-full object-cover shadow-xl rounded pb-5/6"
                                 src="https://images.unsplash.com/photo-1578671815798-7b9b0ab22d73?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                                 alt="bag">
                            <br style="clear: both">
                        </div>
                    </div>
                    <ul>
                        @foreach($posts as $post)
                            <div>
                                @component('components/user-post-card')
                                    @if($post->image->image == "noImageUploaded.jpg")
                                        @slot('image')
                                            {{"https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=925&q=80"}}
                                        @endslot
                                    @else
                                        @slot('image')
                                            {{"/storage/images/".$post->image->image}}
                                        @endslot
                                    @endif

                                    @slot('title')
                                        {{$post->title}}
                                    @endslot
                                    {{$post->description}}

                                    @slot('creator')
                                        {{$post->user->name}}
                                    @endslot
                                @endcomponent
                                <div class="flex items-center space-x-4 justify-end mt-4 top-auto">
                                    <a class="btn bg-blue-600 text-gray-200 px-2 py-2 rounded-md"
                                       href="{{ route('editPost',['id' => $post->id])}}">Edit</a>

                                    <form action="{{route('deletePost',['id'=>$post->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" bg-red-200 text-gray-600 px-2 py-2 rounded-md mr-2"
                                                type="submit">Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
