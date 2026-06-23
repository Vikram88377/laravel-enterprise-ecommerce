<?php

namespace App\Services;

use Exception;
use App\Models\Cart;
use App\Models\Product;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\DB;
use App\Interfaces\OrderRepositoryInterface;

class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private AuditService $auditService,
        private WalletService $walletService
    ) {
    }

    public function placeOrder(int $userId, string $paymentMethod = 'cod')
    {
        return DB::transaction(function () use ($userId, $paymentMethod) {

            $cart = Cart::with([
                'items.product',
                'coupon'
            ])
            ->where('user_id', $userId)
            ->first();

            if (!$cart || $cart->items->count() === 0) {
                throw new Exception('Cart is empty');
            }

            if ($paymentMethod === 'wallet') {
                $this->walletService->debit(
                    $userId,
                    $cart->grand_total,
                    'Order Payment'
                );
            }

            $order = $this->orderRepository->createOrder([
                'user_id' => $userId,
                'coupon_id' => $cart->coupon_id,
                'order_number' => 'ORD-' . time() . '-' . $userId,
                'subtotal' => $cart->subtotal,
                'discount' => $cart->discount,
                'tax' => $cart->tax,
                'shipping_charge' => $cart->shipping_charge,
                'grand_total' => $cart->grand_total,
                'status' => 'pending',
                'payment_status' => $paymentMethod === 'wallet'
                    ? 'paid'
                    : 'pending',
                'payment_method' => $paymentMethod,
            ]);

            foreach ($cart->items as $item) {

                $product = Product::where('id', $item->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw new Exception('Product not found');
                }

                if ($product->stock < $item->quantity) {
                    throw new Exception(
                        'Insufficient stock for product: ' . $product->name
                    );
                }

                $product->decrement(
                    'stock',
                    $item->quantity
                );

                $this->orderRepository->createOrderItem([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'sku' => $product->sku,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);
            }

            $this->auditService->create(
                'ORDER_PLACED',
                'Order',
                $order->id,
                [
                    'order_number' => $order->order_number,
                    'grand_total' => $order->grand_total,
                    'payment_method' => $paymentMethod,
                ],
                $userId
            );

            $cart->items()->delete();

            $cart->update([
                'coupon_id' => null,
                'subtotal' => 0,
                'discount' => 0,
                'tax' => 0,
                'shipping_charge' => 0,
                'grand_total' => 0,
            ]);

            event(
                new OrderPlaced($order)
            );

            return $order->load('items');
        });
    }

    public function getUserOrders(int $userId)
    {
        return $this->orderRepository->getUserOrders($userId);
    }

    public function getOrderDetails(int $userId, int $orderId)
    {
        return $this->orderRepository->findUserOrder(
            $userId,
            $orderId
        );
    }
           
    
    
    public function cancelOrder(int $userId, int $orderId)
{
    return DB::transaction(function () use ($userId, $orderId) {

        $order = $this->orderRepository->findOrderWithItems(
            $userId,
            $orderId
        );

        if (!in_array($order->status, ['pending', 'confirmed'])) {
            throw new Exception(
                'Only pending or confirmed orders can be cancelled'
            );
        }

        foreach ($order->items as $item) {

            $product = Product::where('id', $item->product_id)
                ->lockForUpdate()
                ->first();

            if ($product) {
                $product->increment(
                    'stock',
                    $item->quantity
                );
            }
        }

        $order->update([
            'status' => 'cancelled',
        ]);

        if (
            $order->payment_method === 'wallet' &&
            $order->payment_status === 'paid'
        ) {
            $this->walletService->credit(
                $userId,
                $order->grand_total,
                'Wallet refund for cancelled order'
            );

            $order->update([
                'payment_status' => 'refunded',
            ]);
        }

        $this->auditService->create(
            'ORDER_CANCELLED',
            'Order',
            $order->id,
            [
                'order_number' => $order->order_number,
                'status' => 'cancelled',
                'payment_method' => $order->payment_method,
                'payment_status' => $order->payment_status,
            ],
            $userId
        );

        return $order->load('items');
    });
}
   
}