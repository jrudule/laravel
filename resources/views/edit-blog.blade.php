<x-app-layout>
    <x-slot:title>
        Edit Blog Post
    </x-slot>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <div class="container min-h-screen max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-4">
        <h1 class="text-4xl font-bold mb-6">Edit Blog Post</h1>
        <form action="{{ route('blogPosts.update', $blogPost->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <input  type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm"  
                required placeholder="Title" value="{{ old('title', $blogPost->title) }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <textarea name="body" id="body" rows="5" class="w-full border-gray-300 rounded-md shadow-sm"
                required placeholder="Body Content">{{ old('body', $blogPost->body) }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <label for="categories">Categories:</label>
            <div id="categories">
                @foreach ($categories as $category)
                    <div>
                        <input  type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}"
                                @if ($blogPost->categories->contains($category->id)) checked @endif
                        >
                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="flex gap-2 mt-4">
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-md bg-slate-700 text-white hover:bg-slate-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 rounded-md bg-slate-700 text-white hover:bg-slate-500">
                    Edit Post
                </button>
            </div>
        </form>
    </div>
</x-app-layout>