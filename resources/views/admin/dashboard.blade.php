@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Dashboard Overview</h1>
        <p class="text-sm text-slate-400">{{ now()->format('F j, Y') }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Total Users -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-5 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-100 opacity-80">Total Users</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ number_format($totalUsers) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Deposits (Approved) -->
        <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-xl p-5 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-100 opacity-80">Total Deposits</p>
                    <p class="text-3xl font-bold text-white mt-2">${{ number_format($totalDeposits, 2) }}</p>
                    <p class="text-xs text-green-200 mt-1">Approved</p>
                </div>
                <div class="w-12 h-12 bg-green-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Deposits -->
        <div class="bg-gradient-to-br from-yellow-600 to-yellow-700 rounded-xl p-5 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-100 opacity-80">Pending Deposits</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ number_format($pendingDeposits) }}</p>
                    <p class="text-xs text-yellow-200 mt-1">Awaiting approval</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Withdrawals (Paid) -->
        <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl p-5 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-100 opacity-80">Total Withdrawals</p>
                    <p class="text-3xl font-bold text-white mt-2">${{ number_format($totalWithdrawals, 2) }}</p>
                    <p class="text-xs text-purple-200 mt-1">Paid</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Withdrawals -->
        <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-xl p-5 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-red-100 opacity-80">Pending Withdrawals</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ number_format($pendingWithdrawals) }}</p>
                    <p class="text-xs text-red-200 mt-1">Awaiting payment</p>
                </div>
                <div class="w-12 h-12 bg-red-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.users') }}" class="bg-slate-800 hover:bg-slate-700 rounded-xl p-5 transition flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-white font-semibold">Manage Users</h3>
                <p class="text-sm text-slate-400">View and manage all users</p>
            </div>
        </a>

        <a href="{{ route('admin.deposits') }}" class="bg-slate-800 hover:bg-slate-700 rounded-xl p-5 transition flex items-center gap-4">
            <div class="w-12 h-12 bg-green-600/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-white font-semibold">Approve Deposits</h3>
                <p class="text-sm text-slate-400">Review pending deposits</p>
            </div>
        </a>

        <a href="{{ route('admin.withdrawals') }}" class="bg-slate-800 hover:bg-slate-700 rounded-xl p-5 transition flex items-center gap-4">
            <div class="w-12 h-12 bg-orange-600/20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-white font-semibold">Process Withdrawals</h3>
                <p class="text-sm text-slate-400">Review pending withdrawals</p>
            </div>
        </a>
    </div>

    <!-- Recent Activity Table -->
    <div class="bg-slate-800 rounded-xl overflow-hidden">
        <div class="p-5 border-b border-slate-700">
            <h2 class="text-lg font-semibold text-white">Recent Activity</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($recentActivity as $activity)
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $activity['type'] === 'deposit' ? 'bg-green-600/20 text-green-400' : 'bg-orange-600/20 text-orange-400' }}">
                                {{ ucfirst($activity['type']) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">{{ $activity['user'] }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">${{ number_format($activity['amount'], 2) }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-600/20 text-yellow-400',
                                    'approved' => 'bg-green-600/20 text-green-400',
                                    'active' => 'bg-green-600/20 text-green-400',
                                    'rejected' => 'bg-red-600/20 text-red-400',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$activity['status']] ?? 'bg-slate-600/20 text-slate-400' }}">
                                {{ ucfirst($activity['status']) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-400">
                            {{ $activity['date'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center">
                            <div class="text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="text-sm">No recent activity</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
