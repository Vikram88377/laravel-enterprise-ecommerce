<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
   use HasFactory, SoftDeletes;


        protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'stock',
        'sku',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

        public function images(): HasMany
{
    return $this->hasMany(ProductImage::class);
}


public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

        public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
