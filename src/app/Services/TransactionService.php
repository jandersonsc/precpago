<?php

namespace App\Services;

use App\Services\Interfaces\ITransactionService;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TimeHelper;
use App\Helpers\Consts;

class TransactionService implements ITransactionService {

    public function createTransaction($data): array
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
        Storage::deleteDirectory(Consts::CURRENT_FOLDER_NAME);
        Storage::delete(Consts::SECONDARY_FILE_NAME);
    }

    protected function storePrimaryTransaction($value, $timestamp)
    {
        $path = Consts::CURRENT_FOLDER_NAME . strtotime($timestamp);
        Storage::append($path, $value);
    }

    protected function storeSecondaryTransaction($value)
    {
        $path = Consts::SECONDARY_FILE_NAME;
        Storage::append($path, $value);
    }

    protected function getDifferenceFromTimestampTransaction($timestamp)
    {
        return TimeHelper::dateTimeDiffWithCurrentDate($timestamp);
    }
}
