<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function getOrCreateCart(int $userId)
    {
        return Cart::firstOrCreate([
            'user_id' => $userId
        ]);
    }

    public function findCartItem($cartId, $productId)
    {
        return CartItem::where(
            'cart_id',
            $cartId
        )
        ->where(
            'product_id',
            $productId
        )
        ->first();
    }

    public function createCartItem(array $data)
    {
        return CartItem::create($data);
    }

    public function updateCartItem($cartItem)
    {
        $cartItem->save();

        return $cartItem;
    }

    public function getCartWithItems(int $userId)
    {
        return Cart::with([
            'items.product.images'
        ])
        ->where(
            'user_id',
            $userId
        )
        ->first();
    }

    public function updateCartTotals(
        $cart,
        array $totals
    ) {
        $cart->update($totals);

        return $cart;
    }


        public function deleteCartItem($cartItem)
{
    return $cartItem->delete();
}

public function clearCart($cart)
{
    $cart->items()->delete();

    $cart->update([
        'subtotal' => 0,
        'discount' => 0,
        'tax' => 0,
        'shipping_charge' => 0,
        'grand_total' => 0,
    ]);

    return $cart;
}



}