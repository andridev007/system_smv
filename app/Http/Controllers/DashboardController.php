<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $userId = $user->id;

        // Calculate effective balance from active investments
        $effective_balance = $user->investments()
            ->where('status', 'active')
            ->sum('active_balance');

        Log::info('Effective Balance Calculation', [
            'user_id' => $userId,
            'effective_balance' => $effective_balance,
        ]);

        // Calculate remaining share profit
        // Total share profits earned from all active investments
        $total_share_profit_earned = $user->investments()
            ->where('status', 'active')
            ->with('shareProfits')
            ->get()
            ->flatMap->shareProfits
            ->sum('amount');

        // Total approved withdrawals from share_profit source
        $total_share_profit_wd = $user->withdrawals()
            ->where('source', 'share_profit')
            ->where('status', 'approved')
            ->sum('amount');

        $remaining_share_profit = $total_share_profit_earned - $total_share_profit_wd;

        Log::info('Remaining Share Profit Calculation', [
            'user_id' => $userId,
            'total_share_profit_earned' => $total_share_profit_earned,
            'total_share_profit_wd' => $total_share_profit_wd,
            'remaining_share_profit' => $remaining_share_profit,
        ]);

        // Calculate bonus amounts
        $referral_bonus = $user->bonuses()
            ->where('type', 'referral')
            ->sum('amount');

        $share_profit_bonus = $user->bonuses()
            ->where('type', 'profit_share')
            ->sum('amount');

        // Total bonus earned
        $total_bonus_earned = $referral_bonus + $share_profit_bonus;

        // Total approved withdrawals from bonus source
        $total_bonus_wd = $user->withdrawals()
            ->where('source', 'bonus')
            ->where('status', 'approved')
            ->sum('amount');

        $remaining_bonus = $total_bonus_earned - $total_bonus_wd;

        Log::info('Bonus Calculations', [
            'user_id' => $userId,
            'referral_bonus' => $referral_bonus,
            'share_profit_bonus' => $share_profit_bonus,
            'total_bonus_earned' => $total_bonus_earned,
            'total_bonus_wd' => $total_bonus_wd,
            'remaining_bonus' => $remaining_bonus,
        ]);

        // Calculate total lifetime profit
        $total_profit = $total_share_profit_earned + $total_bonus_earned;

        Log::info('Total Profit Calculation', [
            'user_id' => $userId,
            'total_profit' => $total_profit,
        ]);

        // Other fields for compatibility
        $balance = $user->balance ?? 0.00;
        $profit = $remaining_share_profit; // Profit wallet displays remaining share profit
        $total_deposit = 0.00; // Not implemented yet
        $total_invest = $user->investments()->sum('amount');
        $total_withdraw = $user->withdrawals()
            ->where('status', 'approved')
            ->sum('final_amount');
        $referral_code = $user->referral_code ?? 'SAMUVE001';

        return view('dashboard.index', compact(
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
            'remaining_bonus'
        ));
    }
}
