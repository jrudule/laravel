<x-app-layout>
    <x-slot:title>
        Categories
    </x-slot>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <div class="container min-h-screen max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-4">
        <h1 class="text-4xl font-bold mb-4">Categories</h1>

        <!-- Notifications -->
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Add New Category -->
        <form action="{{ route('categories.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="flex items-center gap-4">
                <input type="text" name="name" placeholder="New category" class="border rounded-md px-4 py-2 mr-2 w-1/2" required>
                <button type="submit" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white bg-slate-700">
                    Add Category
                </button>
            </div>
            @error('name')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </form>

        <!-- List Categories -->
        <ul class="mb-6 mt-6">
            @foreach ($categories as $category)
                <li class="hover:underline text-2xl mb-4">
                    <a href="{{ route('categories.show') }}?category={{ $category->id }}" class="hover:text-orange-500 ">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
