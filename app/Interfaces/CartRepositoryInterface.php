<?php

namespace App\Interfaces;

interface CartRepositoryInterface
{
    public function getOrCreateCart(int $userId);

    public function findCartItem($cartId, $productId);

    public function createCartItem(array $data);

    public function updateCartItem($cartItem);

    public function getCartWithItems(int $userId);

    public function updateCartTotals($cart, array $totals);

    public function deleteCartItem($cartItem);

    public function clearCart($cart);

}