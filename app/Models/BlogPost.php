<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Comment;
use Laravel\Scout\Searchable;

class BlogPost extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_post_category');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    use Searchable;

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }
}


