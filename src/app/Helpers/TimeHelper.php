<?php

namespace App\Helpers;

class TimeHelper {

    public static function dateTimeDiffWithCurrentDate(string $date)
    {
        $date = new \DateTime($date);
        $currentTimestamp = date('U', time());

        return $currentTimestamp - $date->format('U');
    }
}