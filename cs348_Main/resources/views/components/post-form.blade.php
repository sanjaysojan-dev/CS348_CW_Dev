<!-- component -->
<div class="postForm">
    <p class="text-white font-medium">Create Movie Review</p>
    <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST" action="{{route('post')}}"
          enctype="multipart/form-data">
        @csrf

        <div class="mt-2">
            <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" type="text" name="title"
                   placeholder="Title" required>
        </div>

        <div class="mt-2">
            <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="description"
                      placeholder='Type Your Review'></textarea>
        </div>

        <div>
            {{$slot}}
        </div>


        <p class="mt-4 text-gray-800 font-medium">Upload Post Image</p>

        <div class="mt-2">
            <input type="file" name="image_upload" placeholder="Upload Image">
        </div>

        <div class="mt-2">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">POST
            </button>
        </div>
    </form>
</div>
