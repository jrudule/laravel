<x-app-layout>
    <x-slot:title>
        Create new blog
    </x-slot>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <div class="container min-h-screen max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-4">
        <h1 class="text-4xl font-bold mb-6">Create New Blog Post</h1>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('blog.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-md shadow-sm" 
                    value="{{ old('title') }}" required placeholder="Title">
            </div>

            <div class="mb-3">
                <textarea id="body" name="body" class="w-full border-gray-300 rounded-md shadow-sm" rows="5" 
                    required placeholder="Body Content">{{ old('body') }}</textarea>
            </div>

            <label for="categories">Categories:</label>
            <div id="categories">
                @foreach ($categories as $category)
                    <div>
                        <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}">
                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="flex gap-2 mt-4">
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-md bg-slate-700 text-white hover:bg-slate-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 rounded-md bg-slate-700 text-white hover:bg-slate-500">
                    Create Post
                </button>
            </div>
        </form>
    </div>
</x-app-layout>