<?php

namespace App\Services\Interfaces;

interface ITransactionService {

    public function createTransaction($data): void;

    public function deleteAll(): void;
}
