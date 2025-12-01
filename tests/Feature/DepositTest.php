<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DepositTest extends TestCase
{
    /**
     * Test that deposit submission requires authentication.
     */
    public function test_deposit_submission_requires_authentication(): void
    {
        $response = $this->post('/deposit', [
            'amount' => 100,
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertRedirect('/login');
    }

    /**
     * Test that deposit requires amount field.
     */
    public function test_deposit_requires_amount(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post('/deposit', [
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHasErrors('amount');
    }

    /**
     * Test that deposit requires payment method.
     */
    public function test_deposit_requires_payment_method(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post('/deposit', [
            'amount' => 100,
        ]);

        $response->assertSessionHasErrors('payment_method');
    }

    /**
     * Test that deposit amount must be minimum 10.
     */
    public function test_deposit_amount_minimum_is_10(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post('/deposit', [
            'amount' => 5,
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHasErrors('amount');
    }
}
