<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with stats.
     */
    public function index()
    {
        // Statistics for admin dashboard
        $totalUsers = 0;
        $totalDeposits = 0.00; // Total Approved Deposits
        $pendingDeposits = 0;
        $totalWithdrawals = 0.00; // Total Paid Withdrawals
        $pendingWithdrawals = 0;

        // Recent activity (dummy data for now)
        $recentActivity = [];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDeposits',
            'pendingDeposits',
            'totalWithdrawals',
            'pendingWithdrawals',
            'recentActivity'
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

    /**
     * Display admin settings.
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
