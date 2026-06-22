<?php

namespace App\Interfaces;

interface PaymentRepositoryInterface
{
    public function create(array $data);

    public function findByOrderId(int $orderId);

    public function findByGatewayOrderId(string $gatewayOrderId);
}