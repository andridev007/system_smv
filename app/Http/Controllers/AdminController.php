<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\User;
use App\Models\Withdrawal;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with statistics.
     */
    public function index()
    {
        // Get statistics
        $totalUsers = User::count();
        
        // Total approved deposits (investments with active status)
        $totalDeposits = Investment::where('status', 'active')->sum('amount');
        
        // Pending deposits count
        $pendingDeposits = Investment::where('status', 'pending')->count();
        
        // Total paid withdrawals
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        
        // Pending withdrawals count
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
        
        // Recent activity - combine recent deposits and withdrawals
        $recentDeposits = Investment::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($deposit) {
                return [
                    'type' => 'deposit',
                    'user' => $deposit->user->name ?? 'Unknown',
                    'amount' => $deposit->amount,
                    'status' => $deposit->status,
                    'date' => $deposit->created_at ? $deposit->created_at->format('M j, Y H:i') : 'N/A',
                    'timestamp' => $deposit->created_at,
                ];
            });
            
        $recentWithdrawals = Withdrawal::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($withdrawal) {
                return [
                    'type' => 'withdrawal',
                    'user' => $withdrawal->user->name ?? 'Unknown',
                    'amount' => $withdrawal->amount,
                    'status' => $withdrawal->status,
                    'date' => $withdrawal->created_at ? $withdrawal->created_at->format('M j, Y H:i') : 'N/A',
                    'timestamp' => $withdrawal->created_at,
                ];
            });
        
        // Merge and sort by timestamp
        $recentActivity = $recentDeposits->merge($recentWithdrawals)
            ->sortByDesc('timestamp')
            ->take(10)
            ->values();

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
     * Display the users management page.
     */
    public function users()
    {
        $users = User::latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the deposits management page.
     */
    public function deposits()
    {
        $deposits = Investment::with('user')->latest()->paginate(15);

        return view('admin.deposits.index', compact('deposits'));
    }

    /**
     * Approve a deposit (investment).
     */
    public function approveDeposit(Investment $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->with('error', 'This deposit cannot be approved.');
        }

        $deposit->update([
            'status' => 'active',
            'active' => true,
        ]);

        return back()->with('success', 'Deposit approved successfully.');
    }

    /**
     * Reject a deposit (investment).
     */
    public function rejectDeposit(Investment $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->with('error', 'This deposit cannot be rejected.');
        }

        $deposit->update([
            'status' => 'rejected',
            'active' => false,
        ]);

        return back()->with('success', 'Deposit rejected successfully.');
    }

    /**
     * Display the withdrawals management page.
     */
    public function withdrawals()
    {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(15);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    /**
     * Approve a withdrawal.
     */
    public function approveWithdrawal(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'This withdrawal cannot be approved.');
        }

        $withdrawal->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Withdrawal approved and marked as paid.');
    }

    /**
     * Reject a withdrawal.
     */
    public function rejectWithdrawal(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'This withdrawal cannot be rejected.');
        }

        $withdrawal->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Withdrawal rejected successfully.');
    }

    /**
     * Display the settings page.
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
