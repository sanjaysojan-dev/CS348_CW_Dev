<x-app-layout>

    <style>
        #container {
            display: table;
            width: 100%;
            background:#7a7575;
        }

        #container > div {
            display: table-cell;
            padding: 1em;
            word-wrap: break-word;
            height: auto;
            width: 60%;
        }

        #container > div:nth-child(2) {
            width: 40%;
            background: #7a7575;
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
                <div class="p-6 bg-gray-400 border-b border-gray-200">

                    <div id="container">
                        <div class="relative flex mx-auto  justify-center ">
                            <p
                                class="absolute inset-10 text-l text-gray-800 font-medium mr-auto">{{$post->description}}</p>
                            <br style="clear: both">
                        </div>

                        <div class=" flex mx-auto  justify-center">
                            @if($post->image == "noImageUploaded.jpg")
                                <img class="h-80 w-full object-cover shadow rounded pb-5/6"
                                     src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=925&q=80"
                                     alt="bag">
                            @else
                                <img class="h-80 w-full object-cover shadow rounded pb-5/6"
                                     src={{"/storage/images/$post->image"}} alt="bag">
                            @endif
                            <br style="clear: both">
                        </div>
                    </div>

                    <div id="commentSection">
                        <div>
                            <div class="commentForm  flex mx-auto  justify-center shadow-lg ">
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
                el: '#commentSection',
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


