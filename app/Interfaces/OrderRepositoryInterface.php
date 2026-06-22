<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function createOrder(array $data);

    public function createOrderItem(array $data);

    public function getUserOrders(int $userId);

    public function findUserOrder(int $userId, int $orderId);

    public function findOrderWithItems(int $userId, int $orderId);
}