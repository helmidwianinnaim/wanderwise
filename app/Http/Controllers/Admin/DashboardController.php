<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'destinations' => Destination::count(),
            'posts'        => Post::count(),
            'categories'   => Category::count(),
            'featured_destinations' => Destination::where('featured', true)->count(),
            'featured_posts'        => Post::where('featured', true)->count(),
        ];

        $recentDestinations = Destination::latest()->take(5)->get();
        $recentPosts        = Post::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentDestinations', 'recentPosts'));
    }
}
