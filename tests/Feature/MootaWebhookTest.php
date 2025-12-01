<?php

namespace Tests\Feature;

use Tests\TestCase;

class MootaWebhookTest extends TestCase
{
    public function test_webhook_endpoint_is_accessible_without_data(): void
    {
        // When there's no data array provided, the controller should
        // handle empty mutations gracefully without hitting the database
        $response = $this->postJson('/api/moota/webhook', [
            'data' => [],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Processed 0 deposit(s)',
        ]);
    }

    public function test_webhook_ignores_debit_transactions(): void
    {
        // Debit transactions should be ignored without querying the database
        $response = $this->postJson('/api/moota/webhook', [
            'data' => [
                [
                    'amount' => 100123,
                    'type' => 'DB', // Debit, should be ignored
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Processed 0 deposit(s)']);
    }

    public function test_webhook_ignores_zero_amount(): void
    {
        // Zero amount should be ignored without querying the database
        $response = $this->postJson('/api/moota/webhook', [
            'data' => [
                [
                    'amount' => 0,
                    'type' => 'CR',
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Processed 0 deposit(s)']);
    }

    public function test_webhook_ignores_negative_amount(): void
    {
        // Negative amount should be ignored without querying the database
        $response = $this->postJson('/api/moota/webhook', [
            'data' => [
                [
                    'amount' => -50000,
                    'type' => 'CR',
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Processed 0 deposit(s)']);
    }

    public function test_webhook_handles_empty_data_array(): void
    {
        $response = $this->postJson('/api/moota/webhook', [
            'data' => [],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Processed 0 deposit(s)',
        ]);
    }
}
