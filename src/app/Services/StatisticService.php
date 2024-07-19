<?php

namespace App\Services;

use App\Services\Interfaces\IStatisticService;
use App\Helpers\FileManagerHelper;

class StatisticService implements IStatisticService {

    public function getAll(): array
    {
        return $this->getProcessedData();
    }

    public function processTransactions(): void
    {
        $this->processData();
    }

    protected function getProcessedData(): array
    {
        $data = FileManagerHelper::getDataFromStatisticsFile();

        if (empty($data)) {
            return [
                'sum' => 0.00,
                'avg' => 0.00,
                'max' => 0.00,
                'min' => 0.00,
                'count' => 0
            ];
        }

        return $data;
    }

    protected function processData(): void
    {
        $values = $this->getData();
        $result = $this->processValues($values);

        FileManagerHelper::storeDataStatisticsFile($result);
    }

    protected function getData(): array
    {
        return FileManagerHelper::getDataFromPrimaryTransactions();
    }

    protected function processValues($values)
    {
        $collection = collect($values);

        return [
            'sum' => number_format($collection->sum(), 2, '.', ''),
            'avg' => number_format($collection->avg(), 2, '.', ''),
            'max' => number_format($collection->max(), 2, '.', ''),
            'min' => number_format($collection->min(), 2, '.', ''),
            'count' => $collection->count()
        ];
    }
}
