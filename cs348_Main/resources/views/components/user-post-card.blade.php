<div class="userPostCard md:flex shadow-lg  mx-6 md:mx-auto my-5 max-w-lg md:max-w-2xl h-64">
        <img class="h-full w-full md:w-1/3  object-cover rounded-lg rounded-r-none pb-5/6" src={{$image}} alt="bag">
        <div class="w-full md:w-2/3 px-4 py-4 bg-white rounded-lg">
            <div class="flex items-center">
                <h2 class="text-xl text-gray-800 font-medium mr-auto">{{$title}}</h2>
            </div>
            <p class="truncate text-sm text-gray-700 mt-4">
               {{$slot}}
            </p>
            <div class="flex items-center justify-end mt-4 top-auto">
                <button class=" bg-red-200 text-gray-600 px-2 py-2 rounded-md mr-2">Delete</button>
                <button class=" bg-blue-600 text-gray-200 px-2 py-2 rounded-md ">Edit</button>
            </div>
            <div>
                <h2  class="text-xl text-gray-800 font-medium mr-auto">Created By: {{$creator}}</h2>
            </div>
        </div>
</div>
