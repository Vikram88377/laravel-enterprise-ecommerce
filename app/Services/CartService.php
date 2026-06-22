<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\CartRepositoryInterface;
use Exception;

class CartService
{
    public function __construct(
        private CartRepositoryInterface $cartRepository
    ) {
    }

    public function getCart(int $userId)
    {
        return $this->cartRepository->getCartWithItems($userId);
    }

    public function addToCart(int $userId, array $data)
    {
        $product = Product::findOrFail($data['product_id']);

        if ($product->stock < $data['quantity']) {
            throw new Exception('Insufficient product stock');
        }

        $cart = $this->cartRepository->getOrCreateCart($userId);

        $cartItem = $this->cartRepository->findCartItem(
            $cart->id,
            $product->id
        );

        $price = $product->sale_price ?? $product->price;

        if ($cartItem) {
            $cartItem->quantity += $data['quantity'];
            $cartItem->price = $price;
            $cartItem->total = $cartItem->quantity * $price;

            $this->cartRepository->updateCartItem($cartItem);
        } else {
            $this->cartRepository->createCartItem([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $data['quantity'],
                'price' => $price,
                'total' => $data['quantity'] * $price,
            ]);
        }

        $this->recalculateCart($cart);

        return $this->cartRepository->getCartWithItems($userId);
    }

    private function recalculateCart($cart): void
    {
        $cart->load('items');

        $subtotal = $cart->items->sum('total');

        $discount = 0;

        $tax = round($subtotal * 18 / 100, 2);

        $shippingCharge = $subtotal > 1000 ? 0 : 50;

        $grandTotal = $subtotal + $tax + $shippingCharge - $discount;

        $this->cartRepository->updateCartTotals($cart, [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'shipping_charge' => $shippingCharge,
            'grand_total' => $grandTotal,
        ]);
    }

            public function updateQuantity(int $userId, int $productId, int $quantity)
{
    $cart = $this->cartRepository->getOrCreateCart($userId);

    $cartItem = $this->cartRepository->findCartItem(
        $cart->id,
        $productId
    );

    if (!$cartItem) {
        throw new Exception('Product not found in cart');
    }

    if ($cartItem->product->stock < $quantity) {
        throw new Exception('Insufficient product stock');
    }

    $cartItem->quantity = $quantity;
    $cartItem->total = $cartItem->price * $quantity;

    $this->cartRepository->updateCartItem($cartItem);

    $this->recalculateCart($cart);

    return $this->cartRepository->getCartWithItems($userId);
}

public function removeItem(int $userId, int $productId)
{
    $cart = $this->cartRepository->getOrCreateCart($userId);

    $cartItem = $this->cartRepository->findCartItem(
        $cart->id,
        $productId
    );

    if (!$cartItem) {
        throw new Exception('Product not found in cart');
    }

    $this->cartRepository->deleteCartItem($cartItem);

    $this->recalculateCart($cart);

    return $this->cartRepository->getCartWithItems($userId);
}

public function clearCart(int $userId)
{
    $cart = $this->cartRepository->getOrCreateCart($userId);

    return $this->cartRepository->clearCart($cart);
}



}