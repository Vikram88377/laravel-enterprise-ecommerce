<?php

namespace App\Interfaces;

interface WishlistRepositoryInterface
{
    public function getByUser(int $userId);

    public function add(int $userId, int $productId);

    public function remove(int $userId, int $productId);
}