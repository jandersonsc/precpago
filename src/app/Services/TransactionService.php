<?php

namespace App\Services;

use App\Services\Interfaces\ITransactionService;
use App\Helpers\TimeHelper;
use App\Helpers\FileManagerHelper;

class TransactionService implements ITransactionService {

    public function createTransaction($data): int
    {
        $differenceInSeconds = $this->getDifferenceFromTimestampTransaction($data['timestamp']);

        if ($differenceInSeconds > 60) {
            $this->storeSecondaryTransaction($data['amount']);
            return 204;
        }

        $this->storePrimaryTransaction($data['amount'], $data['timestamp']);
        return 201;
    }

    public function deleteAll(): void
    {
        FileManagerHelper::clearAllData();
    }

    protected function storePrimaryTransaction($value, $timestamp)
    {
        $fileName = strtotime($timestamp);
        FileManagerHelper::storeDataPrimaryTransaction($value, $fileName);
    }

    protected function storeSecondaryTransaction($value)
    {
        FileManagerHelper::storeDataSecondaryTransaction($value);
    }

    protected function getDifferenceFromTimestampTransaction($timestamp)
    {
        return TimeHelper::dateTimeDiffWithCurrentDate($timestamp);
    }
}
