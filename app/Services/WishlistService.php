<?php

namespace App\Services;

use App\Interfaces\WishlistRepositoryInterface;

class WishlistService
{
    public function __construct(
        private WishlistRepositoryInterface $wishlistRepository
    ) {
    }

    public function getUserWishlist(int $userId)
    {
        return $this->wishlistRepository->getByUser($userId);
    }

    public function addToWishlist(int $userId, int $productId)
    {
        return $this->wishlistRepository->add($userId, $productId);
    }

    public function removeFromWishlist(int $userId, int $productId)
    {
        return $this->wishlistRepository->remove($userId, $productId);
    }
}