<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'author_id',
        'author_name',
        'is_published',
        'published_at',
        'reading_time',
        'tags',
        'views',
    ];

    protected $casts = [
        'tags'         => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views'        => 'integer',
        'reading_time' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if (empty($post->reading_time) && !empty($post->content)) {
                $wordCount = str_word_count(strip_tags($post->content));
                $post->reading_time = max(1, (int) ceil($wordCount / 200));
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
