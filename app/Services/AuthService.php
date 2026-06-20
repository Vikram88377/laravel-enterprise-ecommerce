<?php

namespace App\Services;

use Exception;
use App\Http\Resources\UserResource;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        private AuthRepositoryInterface $authRepository
    ) {
    }

    public function register(array $data): array
    {
        $user = $this->authRepository->createUser([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'status'   => true,
        ]);

        $user->assignRole('customer');

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user'  => new UserResource($user),
            'token' => $token,
        ];
    }

    public function login(array $data): array
    {
        $user = $this->authRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new Exception('Invalid email or password');
        }

        if (!$user->status) {
            throw new Exception('Your account is inactive');
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user'  => new UserResource($user),
            'token' => $token,
        ];
    }

    public function logout($user): void
    {
        $user->currentAccessToken()->delete();
    }
}