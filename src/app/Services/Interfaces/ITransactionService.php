<?php

namespace App\Services\Interfaces;

interface ITransactionService {

    public function createTransaction($data): int;

    public function deleteAll(): void;
}
