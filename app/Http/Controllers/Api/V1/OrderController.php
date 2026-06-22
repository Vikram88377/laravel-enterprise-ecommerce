<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends BaseApiController
{
    public function __construct(
        private OrderService $orderService
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $order = $this->orderService->placeOrder(
                $request->user()->id
            );

            return $this->successResponse(
                new OrderResource($order),
                'Order placed successfully',
                201
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $orders = $this->orderService->getUserOrders(
                $request->user()->id
            );

            return $this->successResponse(
                OrderResource::collection($orders),
                'Orders fetched successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $order = $this->orderService->getOrderDetails(
                $request->user()->id,
                $id
            );

            return $this->successResponse(
                new OrderResource($order),
                'Order details fetched successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }


        public function cancel(Request $request, int $id): JsonResponse
{
    try {
        $order = $this->orderService->cancelOrder(
            $request->user()->id,
            $id
        );

        return $this->successResponse(
            new OrderResource($order),
            'Order cancelled successfully'
        );

    } catch (Exception $e) {
        return $this->errorResponse(
            $e->getMessage(),
            500
        );
    }
}


}