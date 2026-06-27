<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function create(array $data);

    public function update($user, array $data);

    public function delete($user);
}