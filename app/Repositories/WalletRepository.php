<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Interfaces\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function getOrCreateWallet(int $userId)
    {
        return Wallet::firstOrCreate(
            ['user_id' => $userId],
            ['balance' => 0]
        );
    }

    public function createTransaction(array $data)
    {
        return WalletTransaction::create($data);
    }

            public function findWalletForUpdate(int $userId)
{
    return Wallet::where('user_id', $userId)
        ->lockForUpdate()
        ->first();
}


}