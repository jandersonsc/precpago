<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateTransactions extends Command {

    public function __construct(
            protected \App\Services\TransactionService $service
    )
    {
        parent::__construct();
    }

    protected $signature = 'app:generate-transactions';
    protected $description = 'Generate transaction records';

    public function handle()
    {

        $runnedTime = 0;
        $timesToRunPerMinute = 60;
        $sleep = 60 / $timesToRunPerMinute;

        while ($runnedTime < $timesToRunPerMinute) {

            $payload = [
                'amount' => rand(100, 999),
                'timestamp' => date('Y-m-d\TH:i:s.v\Z')
            ];

            $this->service->createTransaction($payload);
            $runnedTime++;
            sleep($sleep);
        }
    }
}
