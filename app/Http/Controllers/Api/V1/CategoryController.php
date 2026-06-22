<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\CategoryService;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Category\StoreCategoryRequest;

class CategoryController extends BaseApiController
{
    public function __construct(
        private CategoryService $categoryService
    ) {
    }

    public function index()
    {
        try {
            $categories = $this->categoryService->getAll();

            return $this->successResponse(
                CategoryResource::collection($categories),
                'Categories fetched successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create(
                $request->validated()
            );

            return $this->successResponse(
                new CategoryResource($category),
                'Category created successfully',
                201
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }
}