<?php

namespace App\Services;

use App\Services\Interfaces\IStatisticService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Helpers\Consts;

class StatisticService implements IStatisticService {

    protected $filePath = Consts::STATISTICS_FILE_NAME;

    public function getAll(): array
    {
        $result = Storage::get($this->filePath);

        return json_decode($result, true);
    }

    public function processTransactions(): void
    {
        $this->processData();
    }

    protected function processData(): array
    {
        $data = $this->getData();
        $values = Arr::pluck($data, 'amount');
        $collection = collect($values);

        $result = [
            'sum' => number_format($collection->sum(), 2, '.', ''),
            'avg' => number_format($collection->avg(), 2, '.', ''),
            'max' => number_format($collection->max(), 2, '.', ''),
            'min' => number_format($collection->min(), 2, '.', ''),
            'count' => $collection->count()
        ];

        Storage::put($this->filePath, json_encode($result));
    }

    protected function getData(): array
    {
        $content = Storage::get(Consts::CURRENT_FILE_NAME);
        $lines = explode("\n", $content);

        $data = [];
        foreach ($lines as $line) {
            $item = json_decode($line, true);
            $date = new \DateTime($item['timestamp']);
            $currentTimestamp = date('U', time());

            if ($currentTimestamp - $date->format('U') > 60) {
                continue;
            }
            $data[] = $item;
        }

        return $data;
    }
}
