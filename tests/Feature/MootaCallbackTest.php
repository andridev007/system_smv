<?php

namespace Tests\Feature;

use Tests\TestCase;

class MootaCallbackTest extends TestCase
{
    /**
     * Test that callback API endpoint exists and requires amount.
     */
    public function test_callback_requires_amount(): void
    {
        $response = $this->postJson('/api/callback/moota', []);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
            'message' => 'Amount is required',
        ]);
    }
}
