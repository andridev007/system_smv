<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with summary stats.
     */
    public function index()
    {
        // Get summary statistics
        try {
            $totalUsers = User::count();
        } catch (QueryException $e) {
            $totalUsers = 0;
        }

        // Mock data for pending deposits and withdrawals
        // In a real application, these would come from actual Deposit and Withdrawal models
        $pendingDeposits = 5;
        $pendingWithdrawals = 3;

        // Additional stats
        $totalDeposits = 12;
        $totalWithdrawals = 8;
        $totalRevenue = 15000.00;

        return view('admin.dashboard', compact(
            'totalUsers',
            'pendingDeposits',
            'pendingWithdrawals',
            'totalDeposits',
            'totalWithdrawals',
            'totalRevenue'
        ));
    }

    /**
     * Display all users.
     */
    public function users()
    {
        try {
            $users = User::all();
        } catch (QueryException $e) {
            $users = collect([]);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display all deposits.
     */
    public function deposits()
    {
        // Mock deposit data
        // In a real application, this would come from a Deposit model
        $deposits = collect([
            (object) [
                'id' => 1,
                'user_name' => 'John Doe',
                'user_email' => 'john@example.com',
                'amount' => 500.00,
                'payment_method' => 'Bitcoin',
                'status' => 'pending',
                'created_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 2,
                'user_name' => 'Jane Smith',
                'user_email' => 'jane@example.com',
                'amount' => 1000.00,
                'payment_method' => 'Ethereum',
                'status' => 'approved',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 3,
                'user_name' => 'Bob Wilson',
                'user_email' => 'bob@example.com',
                'amount' => 250.00,
                'payment_method' => 'Bitcoin',
                'status' => 'rejected',
                'created_at' => now()->subDays(3),
            ],
            (object) [
                'id' => 4,
                'user_name' => 'Alice Brown',
                'user_email' => 'alice@example.com',
                'amount' => 750.00,
                'payment_method' => 'USDT',
                'status' => 'pending',
                'created_at' => now()->subHours(5),
            ],
            (object) [
                'id' => 5,
                'user_name' => 'Charlie Davis',
                'user_email' => 'charlie@example.com',
                'amount' => 2000.00,
                'payment_method' => 'Bitcoin',
                'status' => 'approved',
                'created_at' => now()->subDays(5),
            ],
        ]);

        return view('admin.deposits.index', compact('deposits'));
    }

    /**
     * Display all withdrawals.
     */
    public function withdrawals()
    {
        // Mock withdrawal data
        // In a real application, this would come from a Withdrawal model
        $withdrawals = collect([
            (object) [
                'id' => 1,
                'user_name' => 'John Doe',
                'user_email' => 'john@example.com',
                'amount' => 200.00,
                'wallet_address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
                'status' => 'pending',
                'created_at' => now()->subHours(3),
            ],
            (object) [
                'id' => 2,
                'user_name' => 'Jane Smith',
                'user_email' => 'jane@example.com',
                'amount' => 500.00,
                'wallet_address' => '0x742d35Cc6634C0532925a3b844Bc9e7595f...',
                'status' => 'processed',
                'created_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 3,
                'user_name' => 'Bob Wilson',
                'user_email' => 'bob@example.com',
                'amount' => 350.00,
                'wallet_address' => 'bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq',
                'status' => 'pending',
                'created_at' => now()->subHours(8),
            ],
            (object) [
                'id' => 4,
                'user_name' => 'Alice Brown',
                'user_email' => 'alice@example.com',
                'amount' => 1000.00,
                'wallet_address' => 'TN2Y2Qvqp7VdZECULqe...',
                'status' => 'processed',
                'created_at' => now()->subDays(2),
            ],
        ]);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    /**
     * Display admin settings page.
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
