<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'author'];

    // Auto-generate slug dari title
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);
        });
    }

    // Supaya route pakai slug bukan id
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
