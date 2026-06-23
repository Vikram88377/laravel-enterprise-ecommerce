<?php

namespace App\Interfaces;

interface WalletRepositoryInterface
{
    public function getOrCreateWallet(int $userId);

    public function createTransaction(array $data);
    public function findWalletForUpdate(int $userId);
}