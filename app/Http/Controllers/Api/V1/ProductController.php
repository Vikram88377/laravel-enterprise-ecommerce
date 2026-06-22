<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UploadProductImageRequest;


class ProductController extends BaseApiController
{
    public function __construct(
        private ProductService $productService
    ) {
    }

    public function index()
    {
        try {

            $products = $this->productService->getAll();

            return $this->successResponse(
                ProductResource::collection($products),
                'Products fetched successfully'
            );

        } catch (Exception $e) {

            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function store(StoreProductRequest $request)
    {
        try {

            $product = $this->productService->create(
                $request->validated()
            );

            return $this->successResponse(
                new ProductResource($product),
                'Product created successfully',
                201
            );

        } catch (Exception $e) {

            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function show(int $id)
    {
        try {

            $product = $this->productService->findById($id);

            return $this->successResponse(
                new ProductResource($product),
                'Product fetched successfully'
            );

        } catch (Exception $e) {

            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }


                    public function uploadImages(
                UploadProductImageRequest $request,
                int $id
            ) {
                try {
                    $product = $this->productService->uploadImages(
                        $id,
                        $request->file('images')
                    );

                    return $this->successResponse(
                        new ProductResource($product),
                        'Product images uploaded successfully'
                    );

                } catch (Exception $e) {
                    return $this->errorResponse(
                        $e->getMessage(),
                        500
                    );
                }
            }



}