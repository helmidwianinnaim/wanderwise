<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Dynamic Stats (Features 5)
        $destinationsCount = Destination::count();
        $articlesCount = Post::count();
        $itinerariesCount = Post::whereHas('category', function($q) {
            $q->where('name', 'like', '%Itinerary%')->orWhere('slug', 'like', '%itinerary%');
        })->count();

        // Fallback for itineraries count if no specific category named 'itinerary' is found
        if ($itinerariesCount === 0) {
           $itinerariesCount = Post::where('title', 'like', '%Itinerary%')
                                ->orWhere('title', 'like', '%Days%')
                                ->count();
        }

        // 2. Popular Searches (Feature 4)
        $popularSearches = Destination::orderByDesc('search_count')
                                      ->orderBy('name')
                                      ->take(5)
                                      ->get(['name', 'slug', 'country']);

        // 3. Featured items for other sections
        $featuredUsaDestinations = Destination::where('region', 'usa')
            ->where('featured', true)
            ->take(3)
            ->get();

        $featuredEuropeDestinations = Destination::where('region', 'europe')
            ->where('featured', true)
            ->take(3)
            ->get();

        $latestPosts = Post::with('category')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('home', compact(
            'featuredUsaDestinations',
            'featuredEuropeDestinations',
            'latestPosts',
            'destinationsCount',
            'articlesCount',
            'itinerariesCount',
            'popularSearches'
        ));
    }
}
