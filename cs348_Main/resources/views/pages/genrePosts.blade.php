<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($allRelatedPosts)>0)
                        <ul>
                            @foreach($allRelatedPosts as $post)
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
                            @endforeach

                        </ul>
                    @else
                        No posts related to this Genre has been created yet!
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
