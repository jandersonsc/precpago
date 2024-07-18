<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateStatistic extends Command {

    public function __construct(
            protected \App\Services\StatisticService $service
    )
    {
        parent::__construct();
    }

    protected $signature = 'app:generate-statistics';
    protected $description = 'Generate statistic records';

    public function handle()
    {

        $runnedTime = 0;
        $timesToRunPerMinute = 12;
        $sleep = 60 / $timesToRunPerMinute;

        while ($runnedTime < $timesToRunPerMinute) {
            $this->service->processTransactions();
            $runnedTime++;
            sleep($sleep);
        }
    }
}
