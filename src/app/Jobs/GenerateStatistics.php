<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateStatistics implements ShouldQueue {

    use Queueable;

    public function __construct(
            protected \App\Services\StatisticService $service
    )
    {
        
    }

    public function handle(): void
    {
        $this->service->processTransactions();
    }
}
