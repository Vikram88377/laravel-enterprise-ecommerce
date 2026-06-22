<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\CartService;
use App\Http\Resources\CartResource;
use App\Http\Requests\Cart\AddToCartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Cart\UpdateCartRequest;

class CartController extends BaseApiController
{
    public function __construct(
        private CartService $cartService
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $cart = $this->cartService->getCart(
                $request->user()->id
            );

            return $this->successResponse(
                $cart ? new CartResource($cart) : null,
                'Cart fetched successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function store(AddToCartRequest $request): JsonResponse
    {
        try {
            $cart = $this->cartService->addToCart(
                $request->user()->id,
                $request->validated()
            );

            return $this->successResponse(
                new CartResource($cart),
                'Product added to cart successfully',
                201
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }


    public function update(
    UpdateCartRequest $request,
    int $productId
): JsonResponse {
    try {


        

        $cart = $this->cartService->updateQuantity(
            $request->user()->id,
            $productId,
            $request->quantity
        );

        return $this->successResponse(
            new CartResource($cart),
            'Cart item quantity updated successfully'
        );

    } catch (Exception $e) {
        return $this->errorResponse(
            $e->getMessage(),
            500
        );
    }
}

public function destroy(
    Request $request,
    int $productId
): JsonResponse {
    try {
        $cart = $this->cartService->removeItem(
            $request->user()->id,
            $productId
        );

        return $this->successResponse(
            new CartResource($cart),
            'Cart item removed successfully'
        );

    } catch (Exception $e) {
        return $this->errorResponse(
            $e->getMessage(),
            500
        );
    }
}

public function clear(Request $request): JsonResponse
{
    try {
        $cart = $this->cartService->clearCart(
            $request->user()->id
        );

        return $this->successResponse(
            new CartResource($cart->load('items.product.images')),
            'Cart cleared successfully'
        );

    } catch (Exception $e) {
        return $this->errorResponse(
            $e->getMessage(),
            500
        );
    }
}
}