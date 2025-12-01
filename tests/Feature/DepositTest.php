<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DepositTest extends TestCase
{
    /**
     * Test that deposit form submission requires authentication.
     */
    public function test_deposit_submission_requires_authentication(): void
    {
        $response = $this->post('/deposit', [
            'amount' => 50000,
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertRedirect('/login');
    }

    /**
     * Test that deposit form submission validates minimum amount.
     */
    public function test_deposit_validates_minimum_amount(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post('/deposit', [
            'amount' => 5000,
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHasErrors('amount');
    }

    /**
     * Test that deposit form submission validates required fields.
     */
    public function test_deposit_validates_required_fields(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post('/deposit', []);

        $response->assertSessionHasErrors(['amount', 'payment_method']);
    }
}
