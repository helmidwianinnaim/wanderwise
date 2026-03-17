<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Post;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $region      = $request->input('region', 'all');
        $filter      = $request->input('filter', '');
        $searchQuery = trim($request->input('q', ''));

        if ($searchQuery === '' || mb_strlen($searchQuery) < 2) {
            $searchQuery = '';
        }

        // --- Sub-filter slug maps ---
        $filterMaps = [
            // USA
            'east-coast'     => ['new-york-city', 'miami'],
            'west-coast'     => ['los-angeles', 'san-francisco', 'las-vegas'],
            'national-parks' => ['las-vegas'],          // gateway to Grand Canyon
            'budget'         => [],                     // handled via rating <= 3
            // Europe by country
            'france'         => ['paris'],
            'italy'          => ['rome'],
            'spain'          => ['barcelona'],
            'netherlands'    => ['amsterdam'],
            'uk'             => ['london'],
            'czech'          => ['prague'],
            'western-europe' => ['paris', 'amsterdam', 'london', 'barcelona'],
            'mediterranean'  => ['rome', 'barcelona'],
        ];

        $query = Destination::query();

        if ($searchQuery !== '') {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('country', 'like', "%{$searchQuery}%");
            });
        } elseif ($filter !== '' && isset($filterMaps[$filter])) {
            $slugs = $filterMaps[$filter];
            if (!empty($slugs)) {
                $query->whereIn('slug', $slugs);
            }
        } elseif ($filter === 'budget') {
            // Budget = rating 3 or lower, cross-region
            $query->where('rating', '<=', 3);
        } elseif ($region !== 'all') {
            $query->where('region', $region);
        }

        $destinations = $query->orderByDesc('featured')->orderBy('name')->get();

        $noResults   = ($searchQuery !== '' || $filter !== '') && $destinations->isEmpty();
        $usaCount    = Destination::where('region', 'usa')->count();
        $europeCount = Destination::where('region', 'europe')->count();
        $totalCount  = Destination::count();
        $popularDestinations = Destination::orderByDesc('search_count')->take(3)->get();

        return view('destinations.index', compact(
            'destinations', 'region', 'filter',
            'usaCount', 'europeCount', 'totalCount',
            'searchQuery', 'noResults', 'popularDestinations'
        ));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();

        // Suggest related destinations (same region, excluding current)
        $related = Destination::where('region', $destination->region)
            ->where('id', '!=', $destination->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('destinations.show', compact('destination', 'related'));
    }
}
