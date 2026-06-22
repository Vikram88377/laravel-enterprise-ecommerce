<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseApiController
{
    public function __construct(
        private AuthService $authService
    ) {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->register(
                $request->validated()
            );

                return $this->successResponse(
                    $result,
                    'User registered successfully',
                    201
                );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login(
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully',
                'data' => $result,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'User profile fetched successfully',
            'data' => $request->user(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout(
            $request->user()
        );

        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully',
        ]);
    }
}