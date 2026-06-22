<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $data)
    {
        return Order::create($data);
    }

    public function createOrderItem(array $data)
    {
        return OrderItem::create($data);
    }

    public function getUserOrders(int $userId)
    {
        return Order::with('items')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function findUserOrder(int $userId, int $orderId)
    {
        return Order::with('items')
            ->where('user_id', $userId)
            ->where('id', $orderId)
            ->firstOrFail();
    }

        public function findOrderWithItems(int $userId, int $orderId)
{
    return Order::with('items')
        ->where('user_id', $userId)
        ->where('id', $orderId)
        ->firstOrFail();
}

        public function getAllOrders()
{
    return Order::with('items')
        ->latest()
        ->get();
}

    public function findOrderById(int $orderId)
    {
        return Order::with('items')
            ->findOrFail($orderId);
    }


}