<!-- component -->
<div class="postCard max-w-xs rounded overflow-hidden shadow-lg my-10">
    <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">
            {{$title}}</div>
        <p class="text-grey-darker text-base">
            {{$slot}}
        </p>
        <div>
            <h2 class="text-l text-gray-800 font-medium mr-auto">Created By: {{$creator}}</h2>
        </div>
    </div>
</div>
