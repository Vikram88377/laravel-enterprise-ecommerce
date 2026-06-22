<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return $this->categoryRepository->create($data);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }
}