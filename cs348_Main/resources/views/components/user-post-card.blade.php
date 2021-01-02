
<a href={{$link}}>
    <div class="userPostCard md:flex shadow-lg  mx-6 md:mx-auto my-5  h-64">
        <img class="h-full w-full md:w-1/3  object-cover rounded-lg rounded-r-none pb-5/6" src={{$image}} alt="bag">
        <div class="w-full md:w-2/3 px-4 py-4 bg-white rounded-lg">
            <div class="flex items-center">
                <h2 class="text-xl text-gray-800 font-medium mr-auto">{{$title}}</h2>
            </div>
            <p class="truncate text-sm text-gray-700 mt-4">
                {{$slot}}
            </p>
            <div class="">
                <h2  class="text-xl text-gray-800 font-medium mr-auto">Created By: {{$creator}}</h2>
            </div>
        </div>
    </div>
</a>
