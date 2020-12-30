<!-- component -->
        <div class="col-span-12 md:border-solid md:border-l md:border-black md:border-opacity-0 h-full pb-12 md:col-span-10">
            <div class="px-4 pt-4">
                <form class="flex flex-col space-y-8"
                      method="POST"
                      action="{{route('updateProfile')}}"
                      enctype="multipart/form-data">
                    @csrf

                    <div>
                        <h3 class="text-2xl font-semibold">Basic Information</h3>
                        <hr>
                    </div>

                    <div class="form-item">
                        <label class="text-xl ">Full Name</label>
                        <input type="text" value="{{ Auth::user()->name }}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2  mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200" disabled>
                    </div>

                    <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">

                        <div class="form-item w-full">
                            <label class="text-xl ">Email</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " disabled>
                        </div>

                        <div class="form-item w-full">
                            <label class="text-xl ">Favourite Film</label>
                            <input type="text" value="{{$favFilm}}" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " name="favFilm">
                        </div>


                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold ">More About Me</h3>
                        <hr>
                    </div>

                    <div class="form-item w-full">
                        <label class="text-xl ">My Interests</label>
                        <textarea cols="30" rows="5" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " name="interests">
                            {{$interests}}
                        </textarea>
                    </div>


                    <div class="form-item w-full">
                        <label class="text-xl ">Is it really my favourite film?</label>
                        <textarea cols="30" rows="5" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " name="reasoning">
                            {{$reasoning}}
                        </textarea>
                    </div>

                    <p class="mt-4 text-gray-800 font-medium">Upload Profile Image</p>
                    <input type="file" name="image_upload" placeholder="Upload Image">
                    @method('PUT')
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded" type="submit">Update
                    </button>

                </form>
            </div>
        </div>

