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
        $this->service->processTransactions();
    }
}
