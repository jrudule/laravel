<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $blogPost->comments()->create([
            'content' => $validated['content'],
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
