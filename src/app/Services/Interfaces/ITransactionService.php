<?php

namespace App\Services\Interfaces;

interface ITransactionService {

    public function createTransaction($data): array;

    public function deleteAll(): void;
}
