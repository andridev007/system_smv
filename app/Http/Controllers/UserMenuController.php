<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

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
     * Handle deposit submission.
     */
    public function storeDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'payment_method' => 'required|string|in:bitcoin,ethereum,usdt_trc20,bank_transfer',
        ]);

        $amount = $request->input('amount');
        $maxAttempts = 10;
        $deposit = null;

        // Generate unique total_amount with retry logic to avoid collisions
        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            $uniqueCode = random_int(1, 999);
            $totalAmount = $amount + $uniqueCode;

            // Check if this total_amount already exists for a pending deposit
            $exists = Deposit::where('status', 'pending')
                ->where('total_amount', $totalAmount)
                ->exists();

            if (! $exists) {
                $deposit = Deposit::create([
                    'user_id' => auth()->id(),
                    'amount' => $amount,
                    'unique_code' => $uniqueCode,
                    'total_amount' => $totalAmount,
                    'payment_method' => $request->input('payment_method'),
                    'status' => 'pending',
                ]);
                break;
            }
        }

        if (! $deposit) {
            return back()->withErrors([
                'amount' => 'Unable to generate a unique deposit code. Please try again.',
            ]);
        }

        return view('user.deposit-confirmation', compact('deposit'));
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
