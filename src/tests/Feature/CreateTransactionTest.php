<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateTransactionTest extends TestCase {

    public function test_createTransactionWithoutPayload(): void
    {
        $response = $this->post('/api/transactions');

        $response->assertStatus(422);
    }

    public function test_createTransactionWithInvalidAmount(): void
    {
        $response = $this->post('/api/transactions', [
            'amount' => 'test',
            'timestamp' => date('Y-m-d\TH:i:s.v\Z')
        ]);

        $response->assertStatus(422);
    }

    public function test_createTransactionWithInvalidTimestamp(): void
    {
        $response = $this->post('/api/transactions', [
            'amount' => '100',
            'timestamp' => date('Y-m-d\TH:i:s.v')
        ]);

        $response->assertStatus(422);
    }

    public function test_createTransactionWithTimestampAtTheFuture(): void
    {
        $now = date('Y-m-d H:i:s');
        $response = $this->post('/api/transactions', [
            'amount' => '100',
            'timestamp' => date('Y-m-d\TH:i:s.v\Z', strtotime('+60 seconds', strtotime($now)))
        ]);

        $response->assertStatus(422);
    }

    public function test_createTransactionWithTimestampAtThePast(): void
    {
        $now = date('Y-m-d H:i:s');
        $response = $this->post('/api/transactions', [
            'amount' => '100',
            'timestamp' => date('Y-m-d\TH:i:s.v\Z', strtotime('-61 seconds', strtotime($now)))
        ]);

        $response->assertStatus(204);
    }

    public function test_createTransactionWithValidPayload(): void
    {
        $response = $this->post('/api/transactions', [
            'amount' => '100',
            'timestamp' => date('Y-m-d\TH:i:s.v\Z')
        ]);

        $response->assertStatus(201);
    }
}
