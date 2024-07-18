<?php

namespace App\Services\Interfaces;

interface IStatisticService {

    public function getAll(): array;

    public function processTransactions(): void;
}
