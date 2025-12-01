<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        // Dummy data for dashboard display
        $balance = 0.00;
        $profit = 0.00;
        $total_deposit = 0.00;
        $total_invest = 0.00;
        $total_withdraw = 0.00;
        $total_profit = 0.00;
        $referral_bonus = 0.00;
        $referral_code = auth()->user()->referral_code ?? 'SAMUVE001';

        // New specific fields as requested
        $effective_balance = 0.00;
        $remaining_share_profit = 0.00;
        $share_profit_bonus = 0.00;
        $remaining_bonus = 0.00;

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
