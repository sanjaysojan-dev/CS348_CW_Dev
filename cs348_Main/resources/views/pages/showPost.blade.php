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
                    </div>
                    <div id="test">
                        <div>
                            <div class="commentForm  flex mx-auto  justify-start shadow-lg ">
                                <form class="w-full max-w-xl bg-white rounded-lg px-4 pt-2">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Add a new comment</h2>
                                        <div class="w-full md:w-full px-3 mb-2 mt-2">
                                            <textarea v-model="commentDescription"
                                                      class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                                      placeholder='Type Your Comment' required></textarea>
                                        </div>
                                        <div class="w-full md:w-full flex items-start md:w-full px-3">
                                            <div class="-mr-1">
                                                <button
                                                    class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                                    @click="createComment" value='Post Comment'>Comment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

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


        <script>
            var app = new Vue({
                el: '#test',
                data: {
                    comments: [],
                    commentDescription: '',
                },
                methods: {
                    createComment: function () {
                        axios.post("{{route('api.submitComment')}}",
                            {
                                description: this.commentDescription,
                                user_id:{{Auth::user()->id}},
                                post_id: {{$post->id}}

                            }).then(response => {
                            this.comments.push(response.data)
                            this.commentDescription = ''
                        }).catch(response => {
                            console.log(response);
                        })
                    }
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
    </div>
</x-app-layout>


