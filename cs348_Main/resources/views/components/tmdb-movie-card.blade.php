<div class=" w-full">
    <div class=" bg-white shadow-2xl rounded-lg mb-6 tracking-wide" >
        <div class="md:flex-shrink-0">
            <img class="object-contain  h-90 w-full " src="https://image.tmdb.org/t/p/original{{$image}}"  alt="mountains" class="w-full h-64 rounded-lg rounded-b-none">
        </div>
        <div class="px-4 py-2 mt-2">
            <h2 class="font-bold text-2xl text-gray-800 tracking-normal">{{$title}}</h2>
            <p class="text-sm text-gray-700 px-2 mr-1">
               {{$overview}}
            </p>
            <div class="flex items-center justify-between mt-2 mx-6">
            </div>
                <h2 class="text-sm tracking-tighter text-gray-900">
                    Release Date:
                    <span class="text-gray-600">{{$releaseDate}}</span>
                </h2>

        </div>
    </div>
</div>
