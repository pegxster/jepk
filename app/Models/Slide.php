<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slide extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'slides';

    protected $fillable = [
        'badge',
        'script',
        'title',
        'phrase',
        'btn1_text',
        'btn1_url',
        'btn2_text',
        'btn2_url',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
