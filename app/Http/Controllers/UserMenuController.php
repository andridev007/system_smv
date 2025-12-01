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
                'description' => 'Basic Investment Plan',
                'min_amount' => 100,
                'max_amount' => 999,
                'daily_profit' => 1.5,
                'duration' => 30,
            ],
            [
                'name' => 'Plan B',
                'description' => 'Standard Investment Plan',
                'min_amount' => 1000,
                'max_amount' => 4999,
                'daily_profit' => 2.0,
                'duration' => 45,
            ],
            [
                'name' => 'Plan C',
                'description' => 'Premium Investment Plan',
                'min_amount' => 5000,
                'max_amount' => 19999,
                'daily_profit' => 2.5,
                'duration' => 60,
            ],
            [
                'name' => 'Plan D',
                'description' => 'VIP Investment Plan',
                'min_amount' => 20000,
                'max_amount' => 100000,
                'daily_profit' => 3.0,
                'duration' => 90,
            ],
        ];

        return view('user.investment', compact('packages'));
    }

    /**
     * Display the withdraw page.
     */
    public function withdraw()
    {
        // Dummy balance for withdrawal
        $available_balance = 0.00;

        return view('user.withdraw', compact('available_balance'));
    }

    /**
     * Display the transactions page.
     */
    public function transactions()
    {
        // Dummy transactions data
        $transactions = [
            [
                'id' => 1,
                'type' => 'Deposit',
                'amount' => 500.00,
                'status' => 'Completed',
                'date' => '2024-12-01 10:30:00',
            ],
            [
                'id' => 2,
                'type' => 'Investment',
                'amount' => 400.00,
                'status' => 'Active',
                'date' => '2024-12-01 11:00:00',
            ],
            [
                'id' => 3,
                'type' => 'Profit',
                'amount' => 6.00,
                'status' => 'Credited',
                'date' => '2024-12-02 00:00:00',
            ],
            [
                'id' => 4,
                'type' => 'Withdrawal',
                'amount' => 100.00,
                'status' => 'Processing',
                'date' => '2024-12-02 09:15:00',
            ],
        ];

        return view('user.transactions', compact('transactions'));
    }

    /**
     * Display the referral page.
     */
    public function referral()
    {
        $referral_code = auth()->user()->referral_code ?? 'SAMUVE001';
        $referral_url = url('/register?ref=' . $referral_code);
        
        // Dummy referral data
        $total_referrals = 5;
        $downlines = [
            [
                'name' => 'John Doe',
                'email' => 'jo***@example.com',
                'joined_date' => '2024-11-15',
                'status' => 'Active',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'ja***@example.com',
                'joined_date' => '2024-11-20',
                'status' => 'Active',
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bo***@example.com',
                'joined_date' => '2024-11-25',
                'status' => 'Inactive',
            ],
        ];

        return view('user.referral', compact('referral_code', 'referral_url', 'total_referrals', 'downlines'));
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
