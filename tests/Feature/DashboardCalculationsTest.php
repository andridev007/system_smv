<?php

namespace Tests\Feature;

use App\Models\Bonus;
use App\Models\Investment;
use App\Models\ShareProfit;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardCalculationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that effective balance is calculated correctly.
     */
    public function test_effective_balance_calculation(): void
    {
        $user = User::factory()->create();

        // Create active investments
        Investment::factory()->create([
            'user_id' => $user->id,
            'status' => 'active',
            'amount' => 1000,
            'active_balance' => 800,
        ]);

        Investment::factory()->create([
            'user_id' => $user->id,
            'status' => 'active',
            'amount' => 2000,
            'active_balance' => 1500,
        ]);

        // Create a pending investment (should not be counted)
        Investment::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'amount' => 500,
            'active_balance' => 500,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('effective_balance', 2300); // 800 + 1500
    }

    /**
     * Test that remaining share profit is calculated correctly.
     */
    public function test_remaining_share_profit_calculation(): void
    {
        $user = User::factory()->create();

        // Create active investment
        $investment = Investment::factory()->create([
            'user_id' => $user->id,
            'status' => 'active',
            'amount' => 1000,
            'active_balance' => 800,
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
            'amount' => 150,
            'date' => now()->addDay(),
            'percentage' => 15,
        ]);

        // Create approved withdrawal from share profit
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 50,
            'fee' => 5,
            'final_amount' => 45,
            'source' => 'share_profit',
            'status' => 'approved',
        ]);

        // Create pending withdrawal (should not be counted)
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 25,
            'fee' => 2,
            'final_amount' => 23,
            'source' => 'share_profit',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('remaining_share_profit', 200); // 100 + 150 - 50
    }

    /**
     * Test that bonus calculations are correct.
     */
    public function test_bonus_calculations(): void
    {
        $user = User::factory()->create();
        $referrer = User::factory()->create();

        // Create referral bonuses
        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $referrer->id,
            'type' => 'referral',
            'amount' => 100,
            'level' => 1,
            'description' => 'Level 1 referral bonus',
        ]);

        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $referrer->id,
            'type' => 'referral',
            'amount' => 50,
            'level' => 2,
            'description' => 'Level 2 referral bonus',
        ]);

        // Create profit share bonuses
        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $referrer->id,
            'type' => 'profit_share',
            'amount' => 75,
            'level' => 1,
            'description' => 'Profit share bonus',
        ]);

        // Create approved withdrawal from bonus
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 30,
            'fee' => 3,
            'final_amount' => 27,
            'source' => 'bonus',
            'status' => 'approved',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('referral_bonus', 150); // 100 + 50
        $response->assertViewHas('share_profit_bonus', 75);
        $response->assertViewHas('remaining_bonus', 195); // (150 + 75) - 30
    }

    /**
     * Test that total lifetime profit is calculated correctly.
     */
    public function test_total_lifetime_profit_calculation(): void
    {
        $user = User::factory()->create();
        $referrer = User::factory()->create();

        // Create investment with share profits
        $investment = Investment::factory()->create([
            'user_id' => $user->id,
            'status' => 'active',
            'amount' => 1000,
            'active_balance' => 800,
        ]);

        ShareProfit::factory()->create([
            'investment_id' => $investment->id,
            'amount' => 200,
            'date' => now(),
            'percentage' => 20,
        ]);

        // Create bonuses
        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $referrer->id,
            'type' => 'referral',
            'amount' => 100,
            'level' => 1,
            'description' => 'Referral bonus',
        ]);

        Bonus::factory()->create([
            'user_id' => $user->id,
            'from_user_id' => $referrer->id,
            'type' => 'profit_share',
            'amount' => 50,
            'level' => 1,
            'description' => 'Profit share bonus',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('total_profit', 350); // 200 + 100 + 50
    }

    /**
     * Test that only approved withdrawals are counted.
     */
    public function test_only_approved_withdrawals_reduce_balance(): void
    {
        $user = User::factory()->create();
        $investment = Investment::factory()->create([
            'user_id' => $user->id,
            'status' => 'active',
            'amount' => 1000,
            'active_balance' => 800,
        ]);

        ShareProfit::factory()->create([
            'investment_id' => $investment->id,
            'amount' => 500,
            'date' => now(),
            'percentage' => 50,
        ]);

        // Approved withdrawal
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 100,
            'fee' => 10,
            'final_amount' => 90,
            'source' => 'share_profit',
            'status' => 'approved',
        ]);

        // Pending withdrawal
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 100,
            'fee' => 10,
            'final_amount' => 90,
            'source' => 'share_profit',
            'status' => 'pending',
        ]);

        // Rejected withdrawal
        Withdrawal::factory()->create([
            'user_id' => $user->id,
            'amount' => 100,
            'fee' => 10,
            'final_amount' => 90,
            'source' => 'share_profit',
            'status' => 'rejected',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('remaining_share_profit', 400); // 500 - 100 (only approved)
    }

    /**
     * Test dashboard with no data returns zeros gracefully.
     */
    public function test_dashboard_with_no_data_returns_zeros(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('effective_balance', 0);
        $response->assertViewHas('remaining_share_profit', 0);
        $response->assertViewHas('referral_bonus', 0);
        $response->assertViewHas('share_profit_bonus', 0);
        $response->assertViewHas('remaining_bonus', 0);
        $response->assertViewHas('total_profit', 0);
    }
}
