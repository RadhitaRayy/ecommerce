<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'unit',
        'price', 'discount_price', 'weight_grams', 'stock', 'image', 'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'discount_price' => 'integer',
        'stock' => 'integer',
        'weight_grams' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($model) => $model->slug = Str::slug($model->name));
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getSellPriceAttribute(): int
    {
        return $this->discount_price ?? $this->price;
    }

    public function getAverageRatingAttribute(): float
    {
        return (float) $this->reviews()->avg('rating');
    }
}
