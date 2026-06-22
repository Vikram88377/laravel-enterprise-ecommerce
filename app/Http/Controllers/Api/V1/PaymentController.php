<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\PaymentService;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends BaseApiController
{
    public function __construct(
        private PaymentService $paymentService
    ) {
    }

    public function cod(Request $request, int $orderId): JsonResponse
    {
        try {
            $payment = $this->paymentService->payByCod(
                $request->user()->id,
                $orderId
            );

            return $this->successResponse(
                new PaymentResource($payment),
                'COD payment selected successfully',
                201
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }


        public function razorpay(Request $request, int $orderId): JsonResponse
{
    try {
        $payment = $this->paymentService->createRazorpayOrder(
            $request->user()->id,
            $orderId
        );

        return $this->successResponse(
            new PaymentResource($payment),
            'Razorpay order created successfully',
            201
        );

    } catch (Exception $e) {
        return $this->errorResponse($e->getMessage(), 500);
    }
}

public function verifyRazorpay(Request $request): JsonResponse
{
    try {
        $request->validate([
            'razorpay_order_id' => ['required'],
            'razorpay_payment_id' => ['required'],
            'razorpay_signature' => ['required'],
        ]);

        $payment = $this->paymentService->verifyRazorpayPayment(
            $request->all()
        );

        return $this->successResponse(
            new PaymentResource($payment),
            'Payment verified successfully'
        );

    } catch (Exception $e) {
        return $this->errorResponse($e->getMessage(), 500);
    }
}

        public function razorpayWebhook(Request $request): JsonResponse
{
    try {
        $payment = $this->paymentService->handleRazorpayWebhook(
            $request
        );

        return response()->json([
            'success' => true,
            'message' => 'Webhook handled successfully',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 400);
    }
}

}