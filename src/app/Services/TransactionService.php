<?php

namespace App\Services;

use App\Services\Interfaces\ITransactionService;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TimeHelper;
use App\Helpers\Consts;

class TransactionService implements ITransactionService {

    protected $filePath = Consts::CURRENT_FOLDER_NAME;
    protected $secondaryFilePath = Consts::SECONDARY_FILE_NAME;

    public function createTransaction($data): array
    {
        $timeDiff = $this->getDifferenceFromTimestampTransaction($data['timestamp']);

        if ($timeDiff > 60) {
            $this->storeSecondaryTransaction($data['amount']);
            return 204;
        }

        $this->storePrimaryTransaction($data['amount'], $data['timestamp']);
        return 201;
    }

    public function deleteAll(): void
    {
        Storage::delete($this->filePath);
        Storage::delete($this->secondaryFilePath);
    }

    protected function storePrimaryTransaction($value, $timestamp)
    {
        $path = $this->filePath . strtotime($timestamp);
        Storage::append($path, $value);
    }

    protected function storeSecondaryTransaction($value)
    {
        $path = $this->secondaryFilePath;
        Storage::append($path, $value);
    }

    protected function getDifferenceFromTimestampTransaction($timestamp)
    {
        return TimeHelper::dateTimeDiffWithCurrentDate($timestamp);
    }
}
