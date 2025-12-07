<?php

namespace Tests\Feature;

use App\Models\Bonus;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\ShareProfit;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

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
        $user = User::factory()->create([
            'referral_code' => 'TESTCODE123',
            'balance' => 0,
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
        $user = User::factory()->create([
            'referral_code' => 'TESTCODE123',
            'balance' => 0,
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
        $user = User::factory()->create([
            'referral_code' => 'TESTCODE123',
            'balance' => 0,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertSee('All Wallets in USD');
        $response->assertSee('Main Wallet');
        $response->assertSee('Profit Wallet');
        $response->assertSee('Deposit');
        $response->assertSee('Investment');
        $response->assertSee('Withdraw');
        $response->assertSee('Effective Balance');
        $response->assertSee('Remaining Share Profit');
        $response->assertSee('Referral Bonus');
        $response->assertSee('Share Profit Bonus');
        $response->assertSee('Remaining Bonus');
        $response->assertSee('Recent Transactions');
    }

    /**
     * Test that dashboard displays the referral link.
     */
    public function test_dashboard_displays_referral_link(): void
    {
        $user = User::factory()->create([
            'referral_code' => 'TESTCODE123',
            'balance' => 0,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertSee('Referral Link');
        $response->assertSee('TESTCODE123');
    }

    /**
     * Test that dashboard shows zero values for user with no activity.
     */
    public function test_dashboard_shows_zero_values_for_new_user(): void
    {
        $user = User::factory()->create([
            'referral_code' => 'TESTCODE123',
            'balance' => 0,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('balance', 0.00);
        $response->assertViewHas('profit', 0.00);
        $response->assertViewHas('total_deposit', 0.00);
        $response->assertViewHas('total_invest', 0.00);
        $response->assertViewHas('effective_balance', 0.00);
        $response->assertViewHas('remaining_share_profit', 0.00);
        $response->assertViewHas('share_profit_bonus', 0.00);
        $response->assertViewHas('remaining_bonus', 0.00);
    }

    /**
     * Test that dashboard correctly calculates effective balance from active investments.
     */
    public function test_dashboard_calculates_effective_balance_correctly(): void
    {
        $user = User::factory()->create(['balance' => 0]);

        // Create active investments with active_balance
        Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'daily',
            'amount' => 1000,
            'status' => 'active',
            'active_balance' => 900,
        ]);

        Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'dream',
            'amount' => 2000,
            'status' => 'active',
            'active_balance' => 1800,
        ]);

        // This should not be counted (not active)
        Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'daily',
            'amount' => 500,
            'status' => 'pending',
            'active_balance' => 450,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('effective_balance', 2700.00); // 900 + 1800
    }

    /**
     * Test that dashboard correctly calculates share profit values.
     */
    public function test_dashboard_calculates_share_profit_correctly(): void
    {
        $user = User::factory()->create(['balance' => 0]);

        $investment = Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'daily',
            'amount' => 1000,
            'status' => 'active',
            'active_balance' => 900,
        ]);

        // Create share profits
        ShareProfit::factory()->create([
            'investment_id' => $investment->id,
            'amount' => 100,
            'date' => now(),
            'percentage' => 10,
        ]);

        ShareProfit::factory()->create([
            'investment_id' => $investment->id,
            'amount' => 50,
            'date' => now(),
            'percentage' => 5,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('remaining_share_profit', 150.00); // 100 + 50
    }

    /**
     * Test that dashboard correctly calculates bonuses.
     */
    public function test_dashboard_calculates_bonuses_correctly(): void
    {
        $user = User::factory()->create(['balance' => 0]);
        $fromUser = User::factory()->create(['balance' => 0]);

        // Create referral bonus
        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $fromUser->id,
            'type' => 'referral',
            'amount' => 100,
            'level' => 1,
            'description' => 'Referral bonus',
        ]);

        // Create profit share bonus
        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $fromUser->id,
            'type' => 'profit_share',
            'amount' => 50,
            'level' => 1,
            'description' => 'Profit share bonus',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('referral_bonus', 100.00);
        $response->assertViewHas('share_profit_bonus', 50.00);
        $response->assertViewHas('remaining_bonus', 150.00); // 100 + 50
    }

    /**
     * Test that dashboard correctly subtracts withdrawals from share profits.
     */
    public function test_dashboard_subtracts_withdrawals_from_share_profits(): void
    {
        $user = User::factory()->create(['balance' => 0]);

        $investment = Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'daily',
            'amount' => 1000,
            'status' => 'active',
        ]);

        // Create share profits
        ShareProfit::factory()->create([
            'investment_id' => $investment->id,
            'amount' => 200,
            'date' => now(),
            'percentage' => 20,
        ]);

        // Create withdrawal from share profit
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 100,
            'fee' => 5,
            'final_amount' => 95,
            'source' => 'share_profit',
            'status' => 'approved',
            'bank_details_snapshot' => json_encode(['bank' => 'Test']),
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('remaining_share_profit', 100.00); // 200 - 100
    }

    /**
     * Test that dashboard correctly subtracts withdrawals from bonuses.
     */
    public function test_dashboard_subtracts_withdrawals_from_bonuses(): void
    {
        $user = User::factory()->create(['balance' => 0]);
        $fromUser = User::factory()->create(['balance' => 0]);

        // Create bonuses
        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $fromUser->id,
            'type' => 'referral',
            'amount' => 200,
            'level' => 1,
            'description' => 'Referral bonus',
        ]);

        // Create withdrawal from bonus
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 100,
            'fee' => 5,
            'final_amount' => 95,
            'source' => 'bonus',
            'status' => 'approved',
            'bank_details_snapshot' => json_encode(['bank' => 'Test']),
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('remaining_bonus', 100.00); // 200 - 100
    }

    /**
     * Test that dashboard calculates total deposits correctly.
     */
    public function test_dashboard_calculates_total_deposits(): void
    {
        $user = User::factory()->create(['balance' => 0]);

        // Approved deposits should be counted
        Deposit::factory()->create([
            'user_id' => $user->id,
            'amount' => 1000,
            'status' => 'approved',
            'payment_method' => 'bank_transfer',
        ]);

        Deposit::factory()->create([
            'user_id' => $user->id,
            'amount' => 500,
            'status' => 'approved',
            'payment_method' => 'bank_transfer',
        ]);

        // Pending deposits should not be counted
        Deposit::factory()->create([
            'user_id' => $user->id,
            'amount' => 300,
            'status' => 'pending',
            'payment_method' => 'bank_transfer',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('total_deposit', 1500.00); // 1000 + 500
    }

    /**
     * Test that dashboard calculates total investments correctly.
     */
    public function test_dashboard_calculates_total_investments(): void
    {
        $user = User::factory()->create(['balance' => 0]);

        // Active and completed investments should be counted
        Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'daily',
            'amount' => 1000,
            'status' => 'active',
        ]);

        Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'dream',
            'amount' => 2000,
            'status' => 'completed',
        ]);

        // Pending/rejected should not be counted
        Investment::factory()->create([
            'user_id' => $user->id,
            'type' => 'daily',
            'amount' => 500,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('total_invest', 3000.00); // 1000 + 2000
    }
}
