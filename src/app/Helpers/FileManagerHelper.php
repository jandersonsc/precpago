<?php

namespace App\Helpers;

use App\Helpers\Consts;
use Illuminate\Support\Facades\Storage;

class FileManagerHelper {

    public static function storeDataPrimaryTransaction($value, $fileName): void
    {
        $path = Consts::CURRENT_FOLDER_NAME . $fileName;
        Storage::append($path, $value);
    }

    public static function storeDataSecondaryTransaction($value): void
    {
        $path = Consts::SECONDARY_FILE_NAME;
        Storage::append($path, $value);
    }

    public static function clearAllData(): void
    {
        Storage::deleteDirectory(Consts::CURRENT_FOLDER_NAME);
        Storage::delete(Consts::SECONDARY_FILE_NAME);
    }

    public static function getDataFromStatisticsFile(): array
    {
        $data = Storage::get(Consts::STATISTICS_FILE_NAME);

        if (empty($data)) {
            return [];
        }

        return json_decode($data, true);
    }

    public static function storeDataStatisticsFile(array $data = [])
    {
        Storage::put(Consts::STATISTICS_FILE_NAME, json_encode($data));
    }

    public static function getDataFromPrimaryTransactions(): array
    {
        $files = Storage::allFiles(Consts::CURRENT_FOLDER_NAME);

        if (empty($files)) {
            return [];
        }

        $data = [];
        foreach ($files as $file) {
            $fileNameTimestamp = str_replace(Consts::CURRENT_FOLDER_NAME, '', $file);

            $diffInSeconds = TimeHelper::timestampDiffWithCurrentDate($fileNameTimestamp);

            if ($diffInSeconds > 60) {
                Storage::delete($file);
                continue;
            }
            $content = Storage::get($file);
            $lines = explode("\n", $content);
            $data = array_merge($data, $lines);
        }

        return $data;
    }
}
