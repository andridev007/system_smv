<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $referralCode = $user?->referral_code ?? '';
        
        // Placeholder data for the dashboard
        $data = [
            'balance' => 0,
            'profit_balance' => 0,
            'total_deposit' => 0,
            'total_investment' => 0,
            'total_profit' => 0,
            'referral_bonus' => 0,
            'total_transactions' => 0,
            'referral_link' => $referralCode ? url('/register?ref=' . $referralCode) : url('/register'),
            'recent_transactions' => [],
        ];

        return view('dashboard.index', $data);
    }
}
