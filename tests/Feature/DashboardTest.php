<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * Test that unauthenticated users are redirected to login.
     */
    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the dashboard.
     */
    public function test_authenticated_users_can_access_dashboard(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.index');
    }

    /**
     * Test that dashboard contains expected data.
     */
    public function test_dashboard_contains_expected_data(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas([
            'balance',
            'profit',
            'total_deposit',
            'total_invest',
            'total_withdraw',
            'total_profit',
            'referral_bonus',
            'referral_code',
            'effective_balance',
            'remaining_share_profit',
            'share_profit_bonus',
            'remaining_bonus',
        ]);
    }

    /**
     * Test that dashboard view contains expected UI elements.
     */
    public function test_dashboard_contains_ui_elements(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertSee('All Wallets in USD');
        $response->assertSee('Main Wallet');
        $response->assertSee('Profit Wallet');
        $response->assertSee('Deposit');
        $response->assertSee('Investment');
        $response->assertSee('Withdraw');
        $response->assertSee('Total Deposit');
        $response->assertSee('Total Investment');
        $response->assertSee('Total Withdraw');
        $response->assertSee('Total Profit');
        $response->assertSee('Referral Bonus');
        $response->assertSee('Recent Transactions');
    }

    /**
     * Test that dashboard displays the referral link.
     */
    public function test_dashboard_displays_referral_link(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'TESTCODE123',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertSee('Your Referral Link');
        $response->assertSee('TESTCODE123');
    }
}
