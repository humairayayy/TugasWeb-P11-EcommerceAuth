<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function user(): BelongsTo     { return $this->belongsTo(User::class); }
    public function orderItems(): HasMany { return $this->hasMany(OrderItem::class); }
    public function reviews(): HasMany    { return $this->hasMany(Review::class); }

    // Scope: hanya produk aktif
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Scope: hanya produk yang stoknya ada
    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }
}