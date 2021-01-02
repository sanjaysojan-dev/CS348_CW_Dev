<x-app-layout>
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
                                <p class="mt-4 text-gray-800 font-medium">Upload Post Image</p>

                                <div class="mt-2">
                                    <input type="file" name="image_upload" placeholder="Upload Image">
                                </div>

                                <div class="mt-2">
                                    @method('PUT')
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                            type="submit">POST
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
