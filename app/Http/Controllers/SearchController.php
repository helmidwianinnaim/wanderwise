<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class SearchController extends Controller
{
    /**
     * Return JSON results for live search
     */
    public function apiSearch(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return response()->json([]);
        }

        $results = Destination::where('name', 'like', "%{$query}%")
                    ->orWhere('country', 'like', "%{$query}%")
                    ->take(5)
                    ->get(['id', 'name', 'slug', 'country', 'region', 'image']);

        return response()->json($results);
    }

    /**
     * Increment search count for a specific destination
     */
    public function apiIncrement(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:destinations,id'
        ]);

        Destination::where('id', $request->input('id'))->increment('search_count');

        return response()->json(['success' => true]);
    }
}
