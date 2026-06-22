<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\WishlistService;
use App\Http\Resources\WishlistResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends BaseApiController
{
    public function __construct(
        private WishlistService $wishlistService
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $wishlists = $this->wishlistService->getUserWishlist(
                $request->user()->id
            );

            return $this->successResponse(
                WishlistResource::collection($wishlists),
                'Wishlist fetched successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'product_id' => ['required', 'exists:products,id'],
            ]);

            $wishlist = $this->wishlistService->addToWishlist(
                $request->user()->id,
                $request->product_id
            );

            $wishlist->load('product.images');

            return $this->successResponse(
                new WishlistResource($wishlist),
                'Product added to wishlist',
                201
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function destroy(Request $request, int $productId): JsonResponse
    {
        try {
            $this->wishlistService->removeFromWishlist(
                $request->user()->id,
                $productId
            );

            return $this->successResponse(
                null,
                'Product removed from wishlist'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }
}