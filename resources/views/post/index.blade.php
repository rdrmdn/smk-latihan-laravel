<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div class="mr-6" style="margin-right: 20px">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <form action="{{route('post.create')}}" method="POST" class="flex flex-col gap-y-4">
                            @csrf
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="mb-4 rounded " required>
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="p-4 mb-4" cols="30" rows="10" required></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="p-2 px-6 rounded border">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full">
                    @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-6">
                        <h2 class="text-xl font-bold">{{$post->title}}</h2>
                        <p class="text-base">{{$post->description}}</p>
                        <p class="text-base text-right">{{$post->created_at->diffForHumans()}}</p>
                        <div class="flex gap-x-2">
                            <a href="{{ route('post.edit', $post->id) }}">Edit</a>
                            <form action="{{ route('post.delete', $post->id) }}" method="POST" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
