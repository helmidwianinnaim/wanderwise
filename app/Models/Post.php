<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'slug', 'excerpt', 'content',
        'author', 'image', 'read_time', 'featured', 'published_at',
    ];

    protected $casts = [
        'featured'     => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
