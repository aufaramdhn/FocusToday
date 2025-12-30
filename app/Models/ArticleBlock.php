<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleBlock extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'type', 'content', 'media_path', 'position'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function getMediaUrlAttribute()
    {
        if ($this->type !== 'image') {
            return null;
        }

        if (empty($this->media_path)) {
            return 'https://via.placeholder.com/800x400?text=No+Image';
        }

        if (str_starts_with($this->media_path, 'http')) {
            return $this->media_path;
        }

        if (Storage::disk('public')->exists($this->media_path)) {
            return asset('storage/' . $this->media_path);
        }

        return 'https://via.placeholder.com/800x400?text=Image+Not+Found';
    }
}
