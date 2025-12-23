<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

        $query->when($filters['start_date'] ?? false, function ($query, $date) {
            return $query->whereDate('created_at', '>=', $date);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $date) {
            return $query->whereDate('created_at', '<=', $date);
        });

        $query->when($filters['sort'] ?? null, function ($query, $sort) {
            switch ($sort) {
                case 'nama_asc':
                    return $query->orderBy('name', 'asc');
                case 'nama_desc':
                    return $query->orderBy('name', 'desc');
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
}
