<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Dummy statistics for admin dashboard
        $totalUsers = 0;
        $totalDeposits = 0.00;
        $pendingWithdrawals = 0;
        $activeInvestments = 0;

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDeposits',
            'pendingWithdrawals',
            'activeInvestments'
        ));
    }

    /**
     * Display all registered users.
     */
    public function users()
    {
        // Dummy data for users list
        $users = [];

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display deposit requests.
     */
    public function deposits()
    {
        // Dummy data for deposits list
        $deposits = [];

        return view('admin.deposits.index', compact('deposits'));
    }

    /**
     * Display withdrawal requests.
     */
    public function withdrawals()
    {
        // Dummy data for withdrawals list
        $withdrawals = [];

        return view('admin.withdrawals.index', compact('withdrawals'));
    }
}
