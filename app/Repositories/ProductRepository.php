<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getAll()
    {
        return Product::with('category', 'images')
            ->latest()
            ->get();
    }

    public function findById(int $id)
    {
        return Product::with('category', 'images')
            ->findOrFail($id);
    }

        public function addImages($product, array $images)
{
    foreach ($images as $imagePath) {
        $product->images()->create([
            'image' => $imagePath,
            'is_primary' => false,
        ]);
    }

    return $product->load('images');
}

}