<x-app-layout>

    <style>
        #container {
            display: table;
            width: 100%;
            background: #374151;
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
            padding-top: 50px;
            padding-right: 30px;
            height: auto;
            background: #374151;
        }
    </style>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Your Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-600 border-b border-gray-200">
                    <div @class=" flex justify-center component('components/post-form')">
                        <div class="postForm">


                            <div id="container">
                                <div class="relative flex mx-auto  justify-center">

                                    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST"
                                          action="{{route('savePost', ['id'=>$post->id])}}"
                                          enctype="multipart/form-data">
                                        <p class="text-gray-800 font-medium">Create Movie Review</p>
                                        @csrf

                                        <div class="mt-2">
                                            <input
                                                class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" type="text"
                                                name="title"
                                                placeholder="Title"
                                                value="{{$post->title}}"
                                                placeholder='Type Your Review' required>
                                        </div>

                                        <div class="mt-2">
                                    <textarea
                                        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                        name="description"
                                        placeholder='Type Your Review'
                                        required>{{$post->description}}</textarea>
                                        </div>
                                        <span class="text-l text-blue-600 pb-4">~ Update Movie Title and Review</span>
                                        <p class="mt-4 text-gray-800 font-medium">Update Post Image ~ Max Image Size:
                                            2MB </p>

                                        <div class="mt-2">
                                            <input type="file" name="image_upload" placeholder="Upload Image">
                                        </div>

                                        <div class="mt-2">
                                            @method('PUT')
                                            <button
                                                class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                                type="submit">POST
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class=" flex mx-auto  justify-center">
                                    @if($post->image->image == "noImageUploaded.jpg")
                                        <img class="h-80 w-full object-cover shadow rounded pb-5/6"
                                             src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=925&q=80"
                                             alt="bag">
                                    @else
                                        <img class="h-80 w-full object-cover shadow rounded pb-5/6"
                                             src={{"/storage/images/".$post->image->image}} alt="bag">
                                    @endif
                                    <br style="clear: both">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
