<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:generate-statistics')
        ->everyFiveSeconds()
        ->withoutOverlapping();
