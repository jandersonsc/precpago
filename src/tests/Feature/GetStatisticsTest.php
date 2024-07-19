<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class GetStatisticsTest extends TestCase {

    public function test_getStatistics(): void
    {
        $response = $this->get('/api/statistics');

        $response->assertStatus(200)
                ->assertJson(fn(AssertableJson $json) =>
                        $json->hasAll([
                            'avg',
                            'sum',
                            'min',
                            'max',
                            'count'
                        ])
        );
    }
}
