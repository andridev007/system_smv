@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Summary Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Total Users Card -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Users</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.users') }}" class="inline-block mt-4 text-sm text-white/80 hover:text-white transition">
                View all users →
            </a>
        </div>

        <!-- Pending Deposits Card -->
        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Pending Deposits</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingDeposits }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.deposits') }}" class="inline-block mt-4 text-sm text-white/80 hover:text-white transition">
                Manage deposits →
            </a>
        </div>

        <!-- Pending Withdrawals Card -->
        <div class="bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Pending Withdrawals</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingWithdrawals }}</p>
                </div>
                <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <a href="{{ route('admin.withdrawals') }}" class="inline-block mt-4 text-sm text-white/80 hover:text-white transition">
                Manage withdrawals →
            </a>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Deposits -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-indigo-300">Total Deposits</p>
                    <p class="text-2xl font-bold text-white">{{ $totalDeposits }}</p>
                </div>
            </div>
        </div>

        <!-- Total Withdrawals -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-indigo-300">Total Withdrawals</p>
                    <p class="text-2xl font-bold text-white">{{ $totalWithdrawals }}</p>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-indigo-300">Total Revenue</p>
                    <p class="text-2xl font-bold text-white">${{ number_format($totalRevenue, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.users') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-800/50 hover:bg-indigo-700/50 rounded-lg transition">
                <svg class="w-8 h-8 text-indigo-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="text-sm text-indigo-200">View Users</span>
            </a>

            <a href="{{ route('admin.deposits') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-800/50 hover:bg-indigo-700/50 rounded-lg transition">
                <svg class="w-8 h-8 text-yellow-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-indigo-200">Review Deposits</span>
            </a>

            <a href="{{ route('admin.withdrawals') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-800/50 hover:bg-indigo-700/50 rounded-lg transition">
                <svg class="w-8 h-8 text-red-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-indigo-200">Process Withdrawals</span>
            </a>

            <a href="{{ route('admin.settings') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-800/50 hover:bg-indigo-700/50 rounded-lg transition">
                <svg class="w-8 h-8 text-indigo-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-sm text-indigo-200">Settings</span>
            </a>
        </div>
    </div>
</div>
@endsection
