<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Comments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="postForm">
                        <p class="text-gray-800 font-medium">Create Movie Review</p>

                        <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST"
                              action="{{route('saveComment', ['id'=>$comment->id])}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="mt-2">
                                    <textarea
                                        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                        name="description"
                                        placeholder='Type Your Review' required>
                                        {{$comment->description}}
                                    </textarea>
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
