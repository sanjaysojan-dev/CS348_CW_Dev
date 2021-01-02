<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-600 border-b ">
                    @if(count($posts)>0)
                        <ul>
                            @foreach($posts as $post)
                                <div class="flex justify-center">
                                    @component('components.post-card')
                                        @slot('link')
                                            {{route('showPost',['id' => $post->id])}}}
                                        @endslot

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
                                </div>

                                @if(Auth::user()->admin)
                                    <form action="{{route('adminDelete',['id'=>$post->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" bg-red-600 text-gray-600 px-2 py-2 rounded-md mr-2"
                                                type="submit">Delete
                                        </button>
                                    </form>
                                @endif

                            @endforeach
                            <div class="flex justify-center bg-white">{{$posts ->links()}}</div>
                        </ul>
                    @else
                        No posts have been created yet!
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
