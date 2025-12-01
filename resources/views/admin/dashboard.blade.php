@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Admin Dashboard</h1>
            <p class="text-sm text-slate-400 mt-1">Overview of your platform statistics</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Users -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-100 font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ number_format($totalUsers) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Deposits (USD) -->
        <div class="bg-gradient-to-br from-green-600 to-green-700 rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-100 font-medium">Total Deposits (USD)</p>
                    <p class="text-3xl font-bold text-white mt-2">${{ number_format($totalDeposits, 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Withdrawals -->
        <div class="bg-gradient-to-br from-orange-600 to-orange-700 rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-orange-100 font-medium">Pending Withdrawals</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ number_format($pendingWithdrawals) }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Investments -->
        <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-100 font-medium">Active Investments</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ number_format($activeInvestments) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-[#111827] rounded-xl p-6 border border-slate-700/50">
        <h2 class="text-lg font-semibold text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('admin.users') }}" class="flex flex-col items-center justify-center p-4 bg-slate-800 rounded-lg hover:bg-slate-700 transition">
                <svg class="w-8 h-8 text-blue-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <span class="text-sm text-slate-300">Manage Users</span>
            </a>
            <a href="{{ route('admin.deposits') }}" class="flex flex-col items-center justify-center p-4 bg-slate-800 rounded-lg hover:bg-slate-700 transition">
                <svg class="w-8 h-8 text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-sm text-slate-300">View Deposits</span>
            </a>
            <a href="{{ route('admin.withdrawals') }}" class="flex flex-col items-center justify-center p-4 bg-slate-800 rounded-lg hover:bg-slate-700 transition">
                <svg class="w-8 h-8 text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="text-sm text-slate-300">Withdrawals</span>
            </a>
            <a href="#" class="flex flex-col items-center justify-center p-4 bg-slate-800 rounded-lg hover:bg-slate-700 transition">
                <svg class="w-8 h-8 text-purple-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span class="text-sm text-slate-300">Investments</span>
            </a>
        </div>
    </div>
</div>
@endsection
