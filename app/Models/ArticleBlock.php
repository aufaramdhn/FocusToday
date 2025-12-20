<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleBlock extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'type', 'content', 'media_path', 'position'];

    // Blok ini milik artikel mana?
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}