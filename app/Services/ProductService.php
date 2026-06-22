<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return $this->productRepository->create($data);
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function findById(int $id)
    {
        return $this->productRepository->findById($id);
    }

        public function uploadImages(int $productId, array $files)
{
    $product = $this->productRepository->findById($productId);

    $imagePaths = [];

    foreach ($files as $file) {
        $imagePaths[] = $file->store('products', 'public');
    }

    return $this->productRepository->addImages(
        $product,
        $imagePaths
    );
}



}