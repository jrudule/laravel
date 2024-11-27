<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function show(Request $request)
    {
        $categoryId = $request->query('category');
        $category = Category::with('blogPosts')->findOrFail($categoryId);

        return view('categories-show', compact('category'));
    }
}
