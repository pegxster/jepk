<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'images',
        'category_id',
        'category_name',
        'stock',
        'sku',
        'is_active',
        'is_featured',
        'tags',
        'materials',
        'colors',
        'badge',
        'rating',
        'review_count',
    ];

    protected $casts = [
        'images'       => 'array',
        'tags'         => 'array',
        'materials'    => 'array',
        'colors'       => 'array',
        'is_active'    => 'boolean',
        'is_featured'  => 'boolean',
        'price'        => 'float',
        'sale_price'   => 'float',
        'stock'        => 'integer',
        'rating'       => 'float',
        'review_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function getMainImageAttribute(): string
    {
        if (!empty($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        return 'images/placeholder.jpg';
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' FCFA';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLowStock($query, int $threshold = 5)
    {
        return $query->where('stock', '<=', $threshold)->where('stock', '>', 0);
    }
}
