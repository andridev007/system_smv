<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request)
    {
        // Get authenticated user (route is protected by auth middleware)
        $user = $request->user();
        
        // Get user name with fallback for demo purposes
        $userName = $user?->name ?? $user?->username ?? 'User';
        $referralCode = $user?->referral_code ?? 'DEMO' . rand(100, 999);
        
        // Dashboard data (dummy values for now - can be replaced with real data from models)
        $data = [
            'userName' => $userName,
            'mainWalletBalance' => 2850.75,
            'profitWalletBalance' => 425.50,
            'weeklyEarnings' => 125.30,
            'referralUrl' => url('/register?ref=' . $referralCode),
            
            // Stats
            'totalDeposit' => 5000.00,
            'totalInvestment' => 4500.00,
            'totalProfit' => 850.25,
            'totalWithdraw' => 1200.00,
            'referralBonus' => 150.00,
            'investmentBonus' => 75.50,
            'rankAchieved' => 'Gold',
            'totalTicket' => 3,
            
            // Recent transactions
            'recentTransactions' => [
                [
                    'type' => 'Deposit',
                    'amount' => 500.00,
                    'status' => 'Completed',
                    'date' => now()->subDays(1)->format('M d, Y'),
                    'icon' => 'deposit',
                ],
                [
                    'type' => 'Investment',
                    'amount' => 1000.00,
                    'status' => 'Active',
                    'date' => now()->subDays(2)->format('M d, Y'),
                    'icon' => 'investment',
                ],
                [
                    'type' => 'Profit',
                    'amount' => 25.50,
                    'status' => 'Credited',
                    'date' => now()->subDays(3)->format('M d, Y'),
                    'icon' => 'profit',
                ],
                [
                    'type' => 'Referral Bonus',
                    'amount' => 50.00,
                    'status' => 'Credited',
                    'date' => now()->subDays(4)->format('M d, Y'),
                    'icon' => 'referral',
                ],
                [
                    'type' => 'Withdraw',
                    'amount' => 200.00,
                    'status' => 'Processing',
                    'date' => now()->subDays(5)->format('M d, Y'),
                    'icon' => 'withdraw',
                ],
            ],
        ];

        return view('dashboard', $data);
    }
}
