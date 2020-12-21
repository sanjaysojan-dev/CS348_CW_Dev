<x-app-layout>

    <style>
        #container {
            display: table;
            width: 100%;
            background: #ccc;
        }

        #container > div {
            display: table-cell;
            padding: 1em;
            width: 50%;
        }

        #container > div:nth-child(2) {
            width: 50%;
            background: #ccc;
        }
    </style>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$post->title}}
        </h2>
    </x-slot>


    <div class="py-12">
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="container">
                        <div>
                            <h2 class="text-l text-gray-800 font-medium mr-auto">{{$post->description}}</h2>
                        </div>
                        <div>
                            @component('components.comment-form')
                            @endcomponent
                        </div>

                        <div id="test">
                            <div v-for="comment in comments">
                                <div id="creator">

                                    @component('components.comment-card')
                                        @slot('commentCreator')
                                            @{{comment.user_id}}
                                        @endslot
                                        @{{comment.description}}
                                    @endcomponent

                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var app = new Vue({
                el: '#test',
                data: {
                    comments: [],
                },
                mounted() {
                    axios.get("{{ route('api.postComments.index',['id' => $post->id])}}")
                        .then(response => {
                            this.comments = response.data
                        }).catch(response => {
                        console.log(response)
                    })
                },
            });

        </script>
    </div>
</x-app-layout>


