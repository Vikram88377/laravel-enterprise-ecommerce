<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WalletRepositoryInterface;

class WalletService
{
    public function __construct(
        private WalletRepositoryInterface $walletRepository
    ) {
    }

    public function getWallet(int $userId)
    {
        return $this->walletRepository
            ->getOrCreateWallet($userId)
            ->load('transactions');
    }

    public function credit(int $userId, float $amount, string $description = null)
    {
        return DB::transaction(function () use ($userId, $amount, $description) {

            $wallet = $this->walletRepository
                ->getOrCreateWallet($userId);

            $wallet->increment('balance', $amount);

            $this->walletRepository->createTransaction([
                'wallet_id' => $wallet->id,
                'type' => 'credit',
                'amount' => $amount,
                'reference' => 'CREDIT-' . time(),
                'description' => $description ?? 'Wallet credited',
            ]);

            return $wallet->fresh()->load('transactions');
        });
    }

public function debit(int $userId, float $amount, string $description = null)
{
    return DB::transaction(function () use ($userId, $amount, $description) {

        $this->walletRepository->getOrCreateWallet($userId);

        $wallet = $this->walletRepository
            ->findWalletForUpdate($userId);

        if (!$wallet) {
            throw new Exception('Wallet not found');
        }

        if ($wallet->balance < $amount) {
            throw new Exception('Insufficient wallet balance');
        }

        $wallet->decrement('balance', $amount);

        $this->walletRepository->createTransaction([
            'wallet_id' => $wallet->id,
            'type' => 'debit',
            'amount' => $amount,
            'reference' => 'DEBIT-' . time(),
            'description' => $description ?? 'Wallet debited',
        ]);

        return $wallet->fresh()->load('transactions');
    });
}
}