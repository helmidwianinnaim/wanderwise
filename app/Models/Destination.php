<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'country', 'region', 'description',
        'image', 'gallery_photos', 'tag', 'guides_count', 'rating', 'featured',
        'search_count',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'gallery_photos' => 'array',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeRegion($query, $region)
    {
        return $query->where('region', $region);
    }
}
