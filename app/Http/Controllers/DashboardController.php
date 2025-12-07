<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        
        // Get user's balance from users table
        $balance = $user->balance ?? 0.00;
        Log::info('Dashboard - User Balance', ['user_id' => $userId, 'balance' => $balance]);

        // Calculate total deposits (approved deposits)
        $total_deposit = DB::table('deposits')
            ->where('user_id', $userId)
            ->where('status', 'approved')
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Total Deposit', ['user_id' => $userId, 'total_deposit' => $total_deposit]);

        // Calculate total investments (active + completed)
        $total_invest = DB::table('investments')
            ->where('user_id', $userId)
            ->whereIn('status', ['active', 'completed'])
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Total Invest', ['user_id' => $userId, 'total_invest' => $total_invest]);

        // Calculate effective balance (sum of active_balance from active investments)
        $effective_balance = DB::table('investments')
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->sum('active_balance') ?? 0.00;
        Log::info('Dashboard - Effective Balance', ['user_id' => $userId, 'effective_balance' => $effective_balance]);

        // Calculate total share profits earned
        $total_share_profits = DB::table('share_profits')
            ->join('investments', 'share_profits.investment_id', '=', 'investments.id')
            ->where('investments.user_id', $userId)
            ->sum('share_profits.amount') ?? 0.00;
        Log::info('Dashboard - Total Share Profits', ['user_id' => $userId, 'total_share_profits' => $total_share_profits]);

        // Calculate share profits withdrawn (only approved withdrawals should reduce balance)
        $share_profit_withdrawn = DB::table('withdrawals')
            ->where('user_id', $userId)
            ->where('source', 'share_profit')
            ->where('status', 'approved')
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Share Profit Withdrawn', ['user_id' => $userId, 'share_profit_withdrawn' => $share_profit_withdrawn]);

        // Remaining share profit = total earned - withdrawn
        $remaining_share_profit = max(0, $total_share_profits - $share_profit_withdrawn);
        Log::info('Dashboard - Remaining Share Profit', ['user_id' => $userId, 'remaining_share_profit' => $remaining_share_profit]);

        // Calculate referral bonus (bonuses where type = 'referral')
        $referral_bonus = DB::table('bonuses')
            ->where('user_id', $userId)
            ->where('type', 'referral')
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Referral Bonus', ['user_id' => $userId, 'referral_bonus' => $referral_bonus]);

        // Calculate share profit bonus (bonuses where type = 'profit_share')
        $share_profit_bonus = DB::table('bonuses')
            ->where('user_id', $userId)
            ->where('type', 'profit_share')
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Share Profit Bonus', ['user_id' => $userId, 'share_profit_bonus' => $share_profit_bonus]);

        // Calculate total bonuses
        $total_bonuses = DB::table('bonuses')
            ->where('user_id', $userId)
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Total Bonuses', ['user_id' => $userId, 'total_bonuses' => $total_bonuses]);

        // Calculate bonuses withdrawn (only approved withdrawals should reduce balance)
        $bonuses_withdrawn = DB::table('withdrawals')
            ->where('user_id', $userId)
            ->where('source', 'bonus')
            ->where('status', 'approved')
            ->sum('amount') ?? 0.00;
        Log::info('Dashboard - Bonuses Withdrawn', ['user_id' => $userId, 'bonuses_withdrawn' => $bonuses_withdrawn]);

        // Remaining bonus = total bonuses - withdrawn
        $remaining_bonus = max(0, $total_bonuses - $bonuses_withdrawn);
        Log::info('Dashboard - Remaining Bonus', ['user_id' => $userId, 'remaining_bonus' => $remaining_bonus]);

        // Calculate total withdrawals (approved)
        $total_withdraw = DB::table('withdrawals')
            ->where('user_id', $userId)
            ->where('status', 'approved')
            ->sum('final_amount') ?? 0.00;
        Log::info('Dashboard - Total Withdraw', ['user_id' => $userId, 'total_withdraw' => $total_withdraw]);

        // Calculate total profit (share profits + bonuses)
        $total_profit = $total_share_profits + $total_bonuses;
        Log::info('Dashboard - Total Profit', ['user_id' => $userId, 'total_profit' => $total_profit]);

        // Profit wallet balance (remaining share profits + remaining bonuses)
        $profit = $remaining_share_profit + $remaining_bonus;
        Log::info('Dashboard - Profit Wallet', ['user_id' => $userId, 'profit' => $profit]);

        // Get referral code
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
