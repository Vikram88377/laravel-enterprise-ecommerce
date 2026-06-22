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
                    $cart->load('items', 'coupon');

                    $subtotal = $cart->items->sum('total');

                    $discount = 0;

                    if ($cart->coupon) {

                        if ($cart->coupon->type === 'fixed') {
                            $discount = $cart->coupon->value;
                        }

                        if ($cart->coupon->type === 'percentage') {
                            $discount = ($subtotal * $cart->coupon->value) / 100;

                            if ($cart->coupon->max_discount) {
                                $discount = min(
                                    $discount,
                                    $cart->coupon->max_discount
                                );
                            }
                        }
                    }

                    $discount = min(
                        $discount,
                        $subtotal
                    );

                    $taxableAmount = $subtotal - $discount;

                    $tax = round(
                        ($taxableAmount * 18) / 100,
                        2
                    );

                    $shippingCharge = $taxableAmount > 1000 ? 0 : 50;

                    $grandTotal = $taxableAmount + $tax + $shippingCharge;

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

public function applyCoupon(int $userId, string $code)
{
    $cart = $this->cartRepository->getCartWithItems($userId);

    if (!$cart || $cart->items->count() === 0) {
        throw new Exception('Cart is empty');
    }

    $coupon = $this->cartRepository->findCouponByCode($code);

    if (!$coupon || !$coupon->status) {
        throw new Exception('Invalid coupon');
    }

    if (now()->lt($coupon->start_date) || now()->gt($coupon->end_date)) {
        throw new Exception('Coupon expired or not active');
    }

    if (
        $coupon->usage_limit &&
        $coupon->used_count >= $coupon->usage_limit
    ) {
        throw new Exception('Coupon usage limit exceeded');
    }

    if ($cart->subtotal < $coupon->min_order_amount) {
        throw new Exception('Minimum order amount not reached');
    }

    $cart->coupon_id = $coupon->id;
    $cart->save();

    $this->recalculateCart($cart);

    return $this->cartRepository->getCartWithItems($userId);
}

public function removeCoupon(int $userId)
{
    $cart = $this->cartRepository->getCartWithItems($userId);

    if (!$cart) {
        throw new Exception('Cart not found');
    }

    $cart->coupon_id = null;
    $cart->save();

    $this->recalculateCart($cart);

    return $this->cartRepository->getCartWithItems($userId);
}

}