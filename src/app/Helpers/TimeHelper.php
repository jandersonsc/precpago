<?php

namespace App\Helpers;

class TimeHelper {

    public static function dateTimeDiffWithCurrentDate(string $date)
    {
        $date = new \DateTime($date);
        $currentTimestamp = date('U', time());

        return $currentTimestamp - $date->format('U');
    }

    public static function timestampDiffWithCurrentDate(int $timestamp)
    {
        $currentTimestamp = date('U', time());

        return $currentTimestamp - $timestamp;
    }
}
