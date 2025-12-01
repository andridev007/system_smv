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
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/deposit');

        $response->assertStatus(200);
        $response->assertViewIs('user.deposit');
        $response->assertSee('Deposit Funds');
        $response->assertSee('Amount (USD)');
        $response->assertSee('Payment Method');
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
        $response->assertSee('Withdraw Funds');
        $response->assertSee('Available Balance');
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
        $response->assertSee('Transaction History');
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
        $user = User::factory()->make(['referral_code' => 'TESTCODE123']);
        $response = $this->actingAs($user)->get('/referral');

        $response->assertStatus(200);
        $response->assertViewIs('user.referral');
        $response->assertSee('Referral Program');
        $response->assertSee('Total Referrals');
        $response->assertSee('Your Downlines');
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
        $user = User::factory()->make(['name' => 'Test User']);
        $response = $this->actingAs($user)->get('/settings');

        $response->assertStatus(200);
        $response->assertViewIs('user.settings');
        $response->assertSee('Account Settings');
        $response->assertSee('Profile Information');
        $response->assertSee('Change Password');
    }
}
