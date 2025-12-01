<?php

namespace App\Http\Controllers;

class UserMenuController extends Controller
{
    /**
     * Display the deposit page.
     */
    public function deposit()
    {
        return view('user.deposit');
    }

    /**
     * Display the investment page.
     */
    public function investment()
    {
        // Dummy investment packages
        $packages = [
            [
                'name' => 'Plan A',
                'min_amount' => 100,
                'max_amount' => 999,
                'daily_profit' => 2.5,
                'duration_days' => 30,
                'total_return' => 75,
            ],
            [
                'name' => 'Plan B',
                'min_amount' => 1000,
                'max_amount' => 4999,
                'daily_profit' => 3.0,
                'duration_days' => 30,
                'total_return' => 90,
            ],
            [
                'name' => 'Plan C',
                'min_amount' => 5000,
                'max_amount' => 9999,
                'daily_profit' => 3.5,
                'duration_days' => 30,
                'total_return' => 105,
            ],
            [
                'name' => 'Plan D',
                'min_amount' => 10000,
                'max_amount' => 50000,
                'daily_profit' => 4.0,
                'duration_days' => 30,
                'total_return' => 120,
            ],
        ];

        return view('user.investment', compact('packages'));
    }

    /**
     * Display the withdraw page.
     */
    public function withdraw()
    {
        $available_balance = 0.00;

        return view('user.withdraw', compact('available_balance'));
    }

    /**
     * Display the transactions page.
     */
    public function transactions()
    {
        // Dummy transactions data
        $transactions = [];

        return view('user.transactions', compact('transactions'));
    }

    /**
     * Display the referral page.
     */
    public function referral()
    {
        $user = auth()->user();
        $referral_code = $user->referral_code ?? 'SAMUVE001';
        $referral_url = url('/register?ref='.$referral_code);
        $total_referrals = 0;
        $downlines = [];

        return view('user.referral', compact(
            'referral_code',
            'referral_url',
            'total_referrals',
            'downlines'
        ));
    }

    /**
     * Display the settings/profile page.
     */
    public function settings()
    {
        $user = auth()->user();

        return view('user.settings', compact('user'));
    }
}
