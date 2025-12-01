<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserMenuTest extends TestCase
{
    /**
     * Test that unauthenticated users are redirected to login for deposit page.
     */
    public function test_deposit_requires_authentication(): void
    {
        $response = $this->get('/deposit');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the deposit page.
     */
    public function test_authenticated_users_can_access_deposit(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/deposit');

        $response->assertStatus(200);
        $response->assertViewIs('user.deposit');
    }

    /**
     * Test that deposit page contains expected elements.
     */
    public function test_deposit_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/deposit');

        $response->assertSee('Deposit Funds');
        $response->assertSee('Amount (IDR)');
        $response->assertSee('Payment Method');
        $response->assertSee('Bitcoin');
        $response->assertSee('Proceed to Payment');
    }

    /**
     * Test that unauthenticated users are redirected to login for investment page.
     */
    public function test_investment_requires_authentication(): void
    {
        $response = $this->get('/investment');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the investment page.
     */
    public function test_authenticated_users_can_access_investment(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/investment');

        $response->assertStatus(200);
        $response->assertViewIs('user.investment');
    }

    /**
     * Test that investment page contains expected elements.
     */
    public function test_investment_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/investment');

        $response->assertSee('Investment Plans');
        $response->assertSee('Daily Plan');
        $response->assertSee('Dream Plan');
        $response->assertSee('Invest Now');
    }

    /**
     * Test that unauthenticated users are redirected to login for withdraw page.
     */
    public function test_withdraw_requires_authentication(): void
    {
        $response = $this->get('/withdraw');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the withdraw page.
     */
    public function test_authenticated_users_can_access_withdraw(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/withdraw');

        $response->assertStatus(200);
        $response->assertViewIs('user.withdraw');
    }

    /**
     * Test that withdraw page contains expected elements.
     */
    public function test_withdraw_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/withdraw');

        $response->assertSee('Withdraw Funds');
        $response->assertSee('Available Balance');
        $response->assertSee('Withdrawal Amount');
        $response->assertSee('Withdrawal Method');
        $response->assertSee('Request Withdrawal');
    }

    /**
     * Test that unauthenticated users are redirected to login for transactions page.
     */
    public function test_transactions_requires_authentication(): void
    {
        $response = $this->get('/transactions');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the transactions page.
     */
    public function test_authenticated_users_can_access_transactions(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/transactions');

        $response->assertStatus(200);
        $response->assertViewIs('user.transactions');
    }

    /**
     * Test that transactions page contains expected elements.
     */
    public function test_transactions_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/transactions');

        $response->assertSee('Transaction History');
        $response->assertSee('No transactions yet');
    }

    /**
     * Test that unauthenticated users are redirected to login for referral page.
     */
    public function test_referral_requires_authentication(): void
    {
        $response = $this->get('/referral');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the referral page.
     */
    public function test_authenticated_users_can_access_referral(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/referral');

        $response->assertStatus(200);
        $response->assertViewIs('user.referral');
    }

    /**
     * Test that referral page contains expected elements.
     */
    public function test_referral_page_contains_expected_elements(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/referral');

        $response->assertSee('Referral Program');
        $response->assertSee('Your Referral Link');
        $response->assertSee('TESTCODE123');
        $response->assertSee('How It Works');
        $response->assertSee('Your Referrals');
    }

    /**
     * Test that unauthenticated users are redirected to login for settings page.
     */
    public function test_settings_requires_authentication(): void
    {
        $response = $this->get('/settings');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the settings page.
     */
    public function test_authenticated_users_can_access_settings(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/settings');

        $response->assertStatus(200);
        $response->assertViewIs('user.settings');
    }

    /**
     * Test that settings page contains expected elements.
     */
    public function test_settings_page_contains_expected_elements(): void
    {
        $user = User::factory()->make([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response = $this->actingAs($user)->get('/settings');

        $response->assertSee('Settings');
        $response->assertSee('Profile Information');
        $response->assertSee('Change Password');
        $response->assertSee('Withdrawal Addresses');
        $response->assertSee('Test User');
        $response->assertSee('test@example.com');
    }
}
