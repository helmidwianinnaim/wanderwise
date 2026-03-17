<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $categorySlug = request('category', 'all');

        $query = Post::with('category')->whereNotNull('published_at');

        if ($categorySlug !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        $posts = $query->latest('published_at')->get();
        $categories = Category::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories', 'categorySlug'));
    }

    public function show($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->firstOrFail();

        $related = Post::with('category')
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'related'));
    }
}
