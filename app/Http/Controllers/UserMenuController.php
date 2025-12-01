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
     * Store a new deposit request.
     */
    public function storeDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'payment_method' => 'required|string',
        ]);

        $amount = $request->input('amount');

        // Generate random 3-digit unique code (100-999)
        $uniqueCode = random_int(100, 999);

        // Calculate total amount
        $amountTotal = $amount + $uniqueCode;

        // Create deposit record
        $deposit = Deposit::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'unique_code' => $uniqueCode,
            'amount_total' => $amountTotal,
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending',
        ]);

        return redirect()->route('user.deposit')->with([
            'success' => 'Deposit request submitted successfully.',
            'deposit' => $deposit,
            'unique_code' => $uniqueCode,
            'amount_total' => $amountTotal,
        ]);
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
