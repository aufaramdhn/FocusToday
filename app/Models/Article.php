<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'status',
        'thumbnail',
        'published_at',
        'views'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function blocks()
    {
        return $this->hasMany(ArticleBlock::class)->orderBy('position');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        });

        $query->when($filters['start_date'] ?? false, function ($query, $date) {
            return $query->whereDate('created_at', '>=', $date);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $date) {
            return $query->whereDate('created_at', '<=', $date);
        });

        $query->when($filters['sort'] ?? null, function ($query, $sort) {
            switch ($sort) {
                case 'nama_asc':
                    return $query->orderBy('title', 'asc');
                case 'nama_desc':
                    return $query->orderBy('title', 'desc');
                case 'tanggal_desc':
                case 'latest':
                    return $query->latest();
                case 'tanggal_asc':
                case 'oldest':
                    return $query->oldest();
                default:
                    return $query->oldest();
            }
        });
    }

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return 'https://via.placeholder.com/400x200?text=No+Image';
        }

        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        if (Storage::disk('public')->exists($this->thumbnail)) {
            return asset('storage/' . $this->thumbnail);
        }

        return 'https://via.placeholder.com/400x200?text=Image+Not+Found';
    }
}
