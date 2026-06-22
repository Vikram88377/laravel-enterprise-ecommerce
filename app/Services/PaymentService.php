<?php

namespace App\Services;

use Exception;
use App\Models\Order;
use App\Interfaces\PaymentRepositoryInterface;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
class PaymentService
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository,
        private AuditService $auditService
    ) {
    }

    public function payByCod(int $userId, int $orderId)
    {
        $order = Order::where('user_id', $userId)
            ->where('id', $orderId)
            ->firstOrFail();

        if ($order->status === 'cancelled') {
            throw new Exception('Cancelled order cannot be paid');
        }

        if ($this->paymentRepository->findByOrderId($order->id)) {
            throw new Exception('Payment already exists for this order');
        }

        $payment = $this->paymentRepository->create([
            'order_id' => $order->id,
            'user_id' => $userId,
            'gateway' => 'cod',
            'amount' => $order->grand_total,
            'status' => 'pending',
            'payload' => [
                'message' => 'Cash on delivery selected'
            ],
        ]);

        $order->update([
            'payment_status' => 'pending',
            'status' => 'confirmed',
        ]);

        $this->auditService->create(
            'COD_PAYMENT_SELECTED',
            'Payment',
            $payment->id,
            [
                'order_id' => $order->id,
                'amount' => $payment->amount,
            ],
            $userId
        );

        return $payment->load('order');
    }


    public function createRazorpayOrder(int $userId, int $orderId)
{
    return DB::transaction(function () use ($userId, $orderId) {

        $order = Order::where('user_id', $userId)
            ->where('id', $orderId)
            ->firstOrFail();

        if ($order->status === 'cancelled') {
            throw new Exception('Cancelled order cannot be paid');
        }

        if ($this->paymentRepository->findByOrderId($order->id)) {
            throw new Exception('Payment already exists for this order');
        }

        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $razorpayOrder = $api->order->create([
            'receipt' => $order->order_number,
            'amount' => (int) ($order->grand_total * 100),
            'currency' => 'INR',
        ]);

        $payment = $this->paymentRepository->create([
            'order_id' => $order->id,
            'user_id' => $userId,
            'gateway' => 'razorpay',
            'gateway_order_id' => $razorpayOrder['id'],
            'amount' => $order->grand_total,
            'status' => 'pending',
            'payload' => $razorpayOrder->toArray(),
        ]);

        return $payment;
    });
}

            public function verifyRazorpayPayment(array $data)
{
    return DB::transaction(function () use ($data) {

        $payment = $this->paymentRepository
            ->findByGatewayOrderId($data['razorpay_order_id']);

        if (!$payment) {
            throw new Exception('Payment record not found');
        }

        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $data['razorpay_order_id'],
            'razorpay_payment_id' => $data['razorpay_payment_id'],
            'razorpay_signature' => $data['razorpay_signature'],
        ]);

        $payment->update([
            'gateway_payment_id' => $data['razorpay_payment_id'],
            'status' => 'paid',
            'payload' => $data,
            'paid_at' => now(),
        ]);

        $payment->order->update([
            'payment_status' => 'paid',
            'status' => 'confirmed',
        ]);

        $this->auditService->create(
            'RAZORPAY_PAYMENT_SUCCESS',
            'Payment',
            $payment->id,
            [
                'order_id' => $payment->order_id,
                'payment_id' => $data['razorpay_payment_id'],
            ],
            $payment->user_id
        );

        return $payment->load('order');
    });
}

        public function handleRazorpayWebhook($request)
{
    $payload = $request->getContent();

    $signature = $request->header('X-Razorpay-Signature');

    $expectedSignature = hash_hmac(
        'sha256',
        $payload,
        config('services.razorpay.webhook_secret')
    );

    if (!hash_equals($expectedSignature, $signature)) {
        throw new Exception('Invalid webhook signature');
    }

    $data = json_decode($payload, true);

    if ($data['event'] === 'payment.captured') {

        $paymentEntity = $data['payload']['payment']['entity'];

        $payment = $this->paymentRepository
            ->findByGatewayOrderId($paymentEntity['order_id']);

        if (!$payment) {
            throw new Exception('Payment record not found');
        }

        if ($payment->status === 'paid') {
            return $payment;
        }

        $payment->update([
            'gateway_payment_id' => $paymentEntity['id'],
            'status' => 'paid',
            'payload' => $data,
            'paid_at' => now(),
        ]);

        $payment->order->update([
            'payment_status' => 'paid',
            'status' => 'confirmed',
        ]);

        $this->auditService->create(
            'RAZORPAY_WEBHOOK_PAYMENT_CAPTURED',
            'Payment',
            $payment->id,
            [
                'razorpay_payment_id' => $paymentEntity['id'],
                'order_id' => $payment->order_id,
            ],
            $payment->user_id
        );

        return $payment;
    }

    return null;
}
}