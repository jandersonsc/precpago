<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetStatisticsTest extends TestCase {

    public function test_getStatistics(): void
    {
        $response = $this->get('/api/statistics');
        $response->assertStatus(200);

        // TODO: Validar se tiver zerado
        $response->assertJson([
            'avg' => true,
            'sum' => true,
            'min' => true,
            'max' => true,
            'count' => true,
        ]);
    }
}
