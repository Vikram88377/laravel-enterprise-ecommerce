<?php

namespace App\Repositories;

use App\Models\Wishlist;
use App\Interfaces\WishlistRepositoryInterface;

class WishlistRepository implements WishlistRepositoryInterface
{
    public function getByUser(int $userId)
    {
        return Wishlist::with('product.images')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function add(int $userId, int $productId)
    {
        return Wishlist::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);
    }

    public function remove(int $userId, int $productId)
    {
        return Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();
    }
}