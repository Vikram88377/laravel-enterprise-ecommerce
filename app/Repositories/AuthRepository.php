<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function findByEmail(string $email)
    {
        return User::where(
            'email',
            $email
        )->first();
    }
}