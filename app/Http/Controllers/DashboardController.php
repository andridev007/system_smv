<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        // Placeholder data for the dashboard
        $data = [
            'balance' => 0,
            'profit_balance' => 0,
            'total_deposit' => 0,
            'total_investment' => 0,
            'total_profit' => 0,
            'referral_bonus' => 0,
            'total_transactions' => 0,
            'referral_link' => url('/register?ref=' . (auth()->user()->referral_code ?? 'default')),
            'recent_transactions' => [],
        ];

        return view('dashboard.index', $data);
    }
}
