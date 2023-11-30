<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{route('post.update', $post->id)}}" method="POST" class="flex flex-col gap-y-4">
                    @csrf
                    @method('put')
                    <label for="title">Title</label>
                    <input type="text" value="{{$post->title}}" name="title" id="title" class="mb-4 rounded " required>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="p-4 mb-4" cols="30" rows="10" required>{{$post->description}}</textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="p-2 px-6 rounded border">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
