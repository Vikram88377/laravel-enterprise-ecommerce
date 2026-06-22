<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function create(array $data);

    public function getAll();

    public function findById(int $id);

    public function addImages($product, array $images);
}