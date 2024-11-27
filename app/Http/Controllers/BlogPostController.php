<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Category;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogPosts = BlogPost::with('user')->latest()->get();
        return view('posts', compact('blogPosts'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $blogPosts = BlogPost::search($search)->paginate(10);

        return view('posts', compact('blogPosts'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create-blog', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $post = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user()->id,
        ]);

        $post->categories()->sync($validatedData['categories']);

        return redirect()->route('blogPosts.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = Category::all();
        return view('edit-blog', compact('blogPost', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'nullable|array',
        ]);

        $blogPost->update($validatedData);
        $blogPost->categories()->sync($request->categories);

        return redirect()->route('blogPosts.index')->with('success', 'Blog post updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('blogPosts.index')->with('success', 'Blog post deleted successfully!');
    }

}
