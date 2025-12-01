<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserMenuTest extends TestCase
{
    /**
     * Test that deposit page requires authentication.
     */
    public function test_deposit_requires_authentication(): void
    {
        $response = $this->get('/deposit');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access deposit page.
     */
    public function test_authenticated_users_can_access_deposit(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/deposit');

        $response->assertStatus(200);
        $response->assertViewIs('user.deposit');
    }

    /**
     * Test that deposit page contains expected UI elements.
     */
    public function test_deposit_contains_ui_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/deposit');

        $response->assertSee('Deposit Funds');
        $response->assertSee('Amount (USD)');
        $response->assertSee('Payment Method');
        $response->assertSee('Bank Transfer');
        $response->assertSee('Cryptocurrency');
    }

    /**
     * Test that investment page requires authentication.
     */
    public function test_investment_requires_authentication(): void
    {
        $response = $this->get('/investment');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access investment page.
     */
    public function test_authenticated_users_can_access_investment(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/investment');

        $response->assertStatus(200);
        $response->assertViewIs('user.investment');
        $response->assertViewHas('packages');
    }

    /**
     * Test that investment page contains expected UI elements.
     */
    public function test_investment_contains_ui_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/investment');

        $response->assertSee('Investment Packages');
        $response->assertSee('Plan A');
        $response->assertSee('Plan B');
        $response->assertSee('Invest Now');
    }

    /**
     * Test that withdraw page requires authentication.
     */
    public function test_withdraw_requires_authentication(): void
    {
        $response = $this->get('/withdraw');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access withdraw page.
     */
    public function test_authenticated_users_can_access_withdraw(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/withdraw');

        $response->assertStatus(200);
        $response->assertViewIs('user.withdraw');
        $response->assertViewHas('available_balance');
    }

    /**
     * Test that withdraw page contains expected UI elements.
     */
    public function test_withdraw_contains_ui_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/withdraw');

        $response->assertSee('Withdraw Funds');
        $response->assertSee('Available Balance');
        $response->assertSee('Withdrawal Amount');
        $response->assertSee('Destination Wallet Address');
    }

    /**
     * Test that transactions page requires authentication.
     */
    public function test_transactions_requires_authentication(): void
    {
        $response = $this->get('/transactions');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access transactions page.
     */
    public function test_authenticated_users_can_access_transactions(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/transactions');

        $response->assertStatus(200);
        $response->assertViewIs('user.transactions');
        $response->assertViewHas('transactions');
    }

    /**
     * Test that transactions page contains expected UI elements.
     */
    public function test_transactions_contains_ui_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/transactions');

        $response->assertSee('Transaction History');
        $response->assertSee('No transactions yet');
    }

    /**
     * Test that referral page requires authentication.
     */
    public function test_referral_requires_authentication(): void
    {
        $response = $this->get('/referral');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access referral page.
     */
    public function test_authenticated_users_can_access_referral(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTREF123',
        ]);

        $response = $this->actingAs($user)->get('/referral');

        $response->assertStatus(200);
        $response->assertViewIs('user.referral');
        $response->assertViewHas([
            'referral_code',
            'referral_url',
            'total_referrals',
            'downlines',
        ]);
    }

    /**
     * Test that referral page contains expected UI elements.
     */
    public function test_referral_contains_ui_elements(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTREF123',
        ]);

        $response = $this->actingAs($user)->get('/referral');

        $response->assertSee('Referral Program');
        $response->assertSee('Total Referrals');
        $response->assertSee('Your Referral Link');
        $response->assertSee('TESTREF123');
    }

    /**
     * Test that settings page requires authentication.
     */
    public function test_settings_requires_authentication(): void
    {
        $response = $this->get('/settings');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access settings page.
     */
    public function test_authenticated_users_can_access_settings(): void
    {
        $user = User::factory()->make([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response = $this->actingAs($user)->get('/settings');

        $response->assertStatus(200);
        $response->assertViewIs('user.settings');
        $response->assertViewHas('user');
    }

    /**
     * Test that settings page contains expected UI elements.
     */
    public function test_settings_contains_ui_elements(): void
    {
        $user = User::factory()->make([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response = $this->actingAs($user)->get('/settings');

        $response->assertSee('Settings');
        $response->assertSee('Profile Information');
        $response->assertSee('Change Password');
        $response->assertSee('Test User');
    }
}
