<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeleteTransactionsTest extends TestCase {

    /**
     * A basic feature test example.
     */
    public function test_deleteTransactions(): void
    {
        $response = $this->delete('/api/transactions');

        $response->assertStatus(204);
    }
}
