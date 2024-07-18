<?php

namespace App\Services;

use App\Services\Interfaces\ITransactionService;
use Illuminate\Support\Facades\Storage;

class TransactionService implements ITransactionService {

    protected $filePath = 'transactions.txt';

    public function createTransaction($data): void
    {
        Storage::append($this->filePath, json_encode($data));
    }

    public function deleteAll(): void
    {
        Storage::delete($this->filePath);
    }
}
