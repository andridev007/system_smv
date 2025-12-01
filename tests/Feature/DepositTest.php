<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DepositTest extends TestCase
{
    public function test_deposit_submission_requires_authentication(): void
    {
        $response = $this->post(route('user.deposit.store'), [
            'amount' => 100000,
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_deposit_form_validation_requires_amount(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post(route('user.deposit.store'), [
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHasErrors('amount');
    }

    public function test_deposit_form_validation_requires_minimum_amount(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post(route('user.deposit.store'), [
            'amount' => 5,
            'payment_method' => 'bank_transfer',
        ]);

        $response->assertSessionHasErrors('amount');
    }

    public function test_deposit_form_validation_requires_valid_payment_method(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post(route('user.deposit.store'), [
            'amount' => 100000,
            'payment_method' => 'invalid_method',
        ]);

        $response->assertSessionHasErrors('payment_method');
    }
}
