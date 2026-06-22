<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function findByOrderId(int $orderId)
    {
        return Payment::where('order_id', $orderId)->first();
    }



        public function findByGatewayOrderId(string $gatewayOrderId)
{
    return Payment::with('order')
        ->where('gateway_order_id', $gatewayOrderId)
        ->first();
}


}