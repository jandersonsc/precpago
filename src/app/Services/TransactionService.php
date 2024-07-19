<?php

namespace App\Services;

use App\Services\Interfaces\ITransactionService;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TimeHelper;

class TransactionService implements ITransactionService {

    protected $filePath = 'current-transactions';
    protected $secondaryFilePath = 'secondary-transactions';

    public function createTransaction($data): array
    {

        $timeDiff = TimeHelper::dateTimeDiffWithCurrentDate($data['timestamp']);

        $secondary = false;
        if ($timeDiff > 60) {
            $secondary = true;
        }

        $fileName = ($secondary) ? $this->secondaryFilePath : $this->filePath;
        Storage::append($fileName, json_encode($data));

        return [
            'code' => ($secondary) ? 204 : 201
        ];
    }

    public function deleteAll(): void
    {
        Storage::delete($this->filePath);
        Storage::delete($this->secondaryFilePath);
    }
}
