<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="p-4 bg-green-400 rounded mb-4">
                <span class="text-base ">{{session('success')}}</span>
            </div>
            @endif
            <div class="flex">
                <div class="mr-6" style="margin-right: 20px">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <form action="{{route('post.create')}}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-y-4">
                            @csrf
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="mb-4 rounded " required>
                            <label for="title">Image</label>
                            <input type="file" name="image" id="image">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="p-4 mb-4" cols="30" rows="10" required></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="p-2 px-6 rounded border w-full bg-blue-400">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full">
                    @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-6">
                        <h2 class="text-xl font-bold">{{$post->title}}</h2>
                        <p class="text-base">{{$post->description}}</p>
                        <p class="text-base">{{$post->user->email}}</p>
                        <img src="/images/{{$post->image_url}}" alt="" class="w-12" />
                        <p class="text-base text-right underline">{{$post->created_at->diffForHumans()}}</p>
                        <div class="flex gap-x-2">
                            <a href="{{ route('post.edit', $post->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                  </svg>

                            </a>
                            <form action="{{ route('post.delete', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 hover:text-gray-200 duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                      </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
