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
     * Display the investment plans page.
     */
    public function investment()
    {
        // Dummy investment plans data
        $plans = [
            [
                'name' => 'Daily Plan',
                'type' => 'daily',
                'min_amount' => 50,
                'max_amount' => 999,
                'roi_percentage' => 2.5,
                'duration' => '30 Days',
                'description' => 'Earn daily returns with our basic investment plan.',
            ],
            [
                'name' => 'Dream Plan',
                'type' => 'dream',
                'min_amount' => 1000,
                'max_amount' => 50000,
                'roi_percentage' => 5,
                'duration' => '90 Days',
                'description' => 'Higher returns for serious investors.',
            ],
        ];

        return view('user.investment', compact('plans'));
    }

    /**
     * Display the withdraw page.
     */
    public function withdraw()
    {
        // Dummy data for available balance
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
        $referral_code = auth()->user()->referral_code ?? 'SAMUVE001';
        $referral_link = url('/register?ref='.$referral_code);

        // Dummy referrals data
        $referrals = [];

        return view('user.referral', compact('referral_code', 'referral_link', 'referrals'));
    }

    /**
     * Display the settings page.
     */
    public function settings()
    {
        $user = auth()->user();

        return view('user.settings', compact('user'));
    }
}
