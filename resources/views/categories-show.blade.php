<x-app-layout>
    <x-slot:title>
        {{ $category->name }}
    </x-slot>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <div class="container min-h-screen max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-4">
        <h1 class="text-4xl font-bold mb-4">Category: {{ $category->name }}</h1>

        <a  href="{{ route('categories.index') }}" 
            class="rounded-md my-4 px-3 py-2 text-white ring-1 ring-transparent hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white bg-slate-700"
        >
            Back to Categories
        </a>

        @if($category->blogPosts->isNotEmpty())
            @foreach($category->blogPosts as $blogPost)
                <div class="mb-8">
                    <div href="{{ route('blogPosts.show', $blogPost) }}" class="border-2 border-slate-700 rounded-md p-4 my-4">
                        <div class="mb-4">
                            <div class="mb-1 font-semibold text-xl">{{ $blogPost->title }}</div>
                            <p class="mb-1">{{ $blogPost->body }}</p>
                            <small class="text-black/50">By {{ $blogPost->user->name }} on {{ $blogPost->created_at->format('d M Y, h:i A') }}</small>
                            
                            @if ($blogPost->categories->isNotEmpty())
                                <p class="pt-2 ">Categories: 
                                    @foreach ($blogPost->categories as $category)
                                        <a  href="{{ route('categories.show') }}?category={{ $category->id }}"
                                            class="text-blue-600 hover:underline"
                                        >
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </p>   
                            @endif
                            
                        </div>
                        <div class="grid grid-flow-col gap-2">
                            @auth  
                                <div class="flex gap-2">
                                    @if (auth()->id() === $blogPost->user_id) 
                                        <a href="{{ route('blogPosts.edit', $blogPost) }}" class="p-2 rounded-md bg-slate-700 text-white hover:text-black/70">
                                            Edit
                                        </a>
                                        <form action="{{ route('blogPosts.destroy', $blogPost) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-md bg-slate-700 text-white hover:text-black/70">
                                                Delete
                                            </button>
                                        </form> 
                                    @endif
                                    <button type="button" class="coment p-2 rounded-md bg-slate-700 text-white hover:text-black/70 w-max cursor-pointer">
                                        Coment
                                    </button>
                                </div>   
                            @endauth
                            
                            @if ($blogPost->updated_at != $blogPost->created_at)
                                <div class="self-center justify-self-end text-black/50  p-2 ">
                                    Updated
                                </div>
                            @endif
                        </div>
                    </div>
                    @auth
                        <div id="commentFormContainer" style="display: none;" class="mb-4">
                            <form action="{{ route('comments.store', $blogPost) }}" method="POST" class="flex flex-col gap-2">
                                @csrf
                                <textarea name="content" placeholder="Write your comment here..." required class="w-full rounded"></textarea>
                                <button type="submit" class="p-2 rounded-md bg-slate-700 text-white hover:text-black/70 w-max">
                                    Add Comment
                                </button>
                            </form>
                        </div>
                    @endauth

                    @foreach ($blogPost->comments as $comment)
                        <div class="border-2 border-slate-700 rounded-md p-4 ml-8">
                            <p><strong>{{ $comment->user->name }}</strong> comented:</p>
                            <p class="my-4">{{ $comment->content }}</p>
                            @if (auth()->id() === $blogPost->user_id)  
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-md bg-slate-700 text-white hover:text-black/70">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p class="py-4">No posts found in this category.</p>
        @endif
    </div>
</x-app-layout>