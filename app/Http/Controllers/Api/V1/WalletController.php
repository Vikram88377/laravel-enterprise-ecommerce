<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\WalletService;
use App\Http\Resources\WalletResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WalletController extends BaseApiController
{
    public function __construct(
        private WalletService $walletService
    ) {
    }

    public function show(Request $request): JsonResponse
    {
        try {
            $wallet = $this->walletService->getWallet(
                $request->user()->id
            );

            return $this->successResponse(
                new WalletResource($wallet),
                'Wallet fetched successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function credit(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'amount' => ['required', 'numeric', 'min:1'],
                'description' => ['nullable', 'string'],
            ]);

            $wallet = $this->walletService->credit(
                $request->user()->id,
                $request->amount,
                $request->description
            );

            return $this->successResponse(
                new WalletResource($wallet),
                'Wallet credited successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }

    public function debit(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'amount' => ['required', 'numeric', 'min:1'],
                'description' => ['nullable', 'string'],
            ]);

            $wallet = $this->walletService->debit(
                $request->user()->id,
                $request->amount,
                $request->description
            );

            return $this->successResponse(
                new WalletResource($wallet),
                'Wallet debited successfully'
            );

        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                500
            );
        }
    }
}