<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function getAll()
    {
        return Category::latest()->get();
    }
}