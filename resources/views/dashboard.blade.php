@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                <span class="text-white text-lg font-semibold">{{ substr($userName ?? 'U', 0, 1) }}</span>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Welcome back,</p>
                <h2 class="text-lg font-semibold text-white">{{ $userName ?? 'User' }}</h2>
            </div>
        </div>
        <button class="relative p-2 text-gray-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
    </div>

    <!-- Main Wallet Card -->
    <div class="bg-gradient-to-r from-purple-600 via-purple-500 to-blue-500 rounded-2xl p-6 shadow-lg">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-purple-200 text-sm">Main Wallet</p>
                <h3 class="text-3xl font-bold text-white">${{ number_format($mainWalletBalance, 2) }}</h3>
            </div>
            <div class="text-right">
                <p class="text-purple-200 text-sm">Profit Wallet</p>
                <h4 class="text-xl font-semibold text-white">${{ number_format($profitWalletBalance, 2) }}</h4>
            </div>
        </div>
        <div class="flex items-center gap-2 text-purple-100 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            <span>You Earned ${{ number_format($weeklyEarnings, 2) }} USD This Week</span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="grid grid-cols-3 gap-3">
        <a href="#" class="flex flex-col items-center justify-center p-4 bg-green-500 hover:bg-green-600 rounded-xl transition-colors">
            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="text-white font-medium text-sm">Deposit</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center p-4 bg-purple-400 hover:bg-purple-500 rounded-xl transition-colors">
            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            <span class="text-white font-medium text-sm">Investment</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center p-4 bg-orange-400 hover:bg-orange-500 rounded-xl transition-colors">
            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="text-white font-medium text-sm">Withdraw</span>
        </a>
    </div>

    <!-- Referral Section -->
    <div class="bg-navy-800 rounded-xl p-4" x-data="{ copied: false }">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-white font-semibold">Referral Link</h4>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <div class="flex items-center gap-2">
            <input type="text" 
                   value="{{ $referralUrl }}" 
                   readonly 
                   id="referralUrl"
                   class="flex-1 bg-navy-700 text-gray-300 text-sm px-4 py-3 rounded-lg border border-navy-600 focus:outline-none truncate">
            <button @click="navigator.clipboard.writeText('{{ $referralUrl }}'); copied = true; setTimeout(() => copied = false, 2000)"
                    class="px-4 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition-colors whitespace-nowrap">
                <span x-show="!copied">COPY</span>
                <span x-show="copied" x-cloak>COPIED!</span>
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <!-- Total Deposit -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-yellow-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Total Deposit</p>
            <p class="text-white font-bold text-lg">${{ number_format($totalDeposit, 2) }}</p>
        </div>

        <!-- Total Investment -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-purple-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Total Investment</p>
            <p class="text-white font-bold text-lg">${{ number_format($totalInvestment, 2) }}</p>
        </div>

        <!-- Total Profit -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-blue-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Total Profit</p>
            <p class="text-white font-bold text-lg">${{ number_format($totalProfit, 2) }}</p>
        </div>

        <!-- Total Withdraw -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-orange-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Total Withdraw</p>
            <p class="text-white font-bold text-lg">${{ number_format($totalWithdraw, 2) }}</p>
        </div>

        <!-- Referral Bonus -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-green-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Referral Bonus</p>
            <p class="text-white font-bold text-lg">${{ number_format($referralBonus, 2) }}</p>
        </div>

        <!-- Investment Bonus -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-indigo-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Investment Bonus</p>
            <p class="text-white font-bold text-lg">${{ number_format($investmentBonus, 2) }}</p>
        </div>

        <!-- Rank Achieved -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-amber-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Rank Achieved</p>
            <p class="text-white font-bold text-lg">{{ $rankAchieved }}</p>
        </div>

        <!-- Total Ticket -->
        <div class="bg-navy-800 rounded-xl p-4 border-l-4 border-cyan-400">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-xs">Total Ticket</p>
            <p class="text-white font-bold text-lg">{{ $totalTicket }}</p>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-navy-800 rounded-xl p-4">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-white font-semibold">Recent Transactions</h4>
            <a href="#" class="text-purple-400 text-sm hover:text-purple-300">View All</a>
        </div>
        <div class="space-y-3">
            @foreach($recentTransactions as $transaction)
            <div class="flex items-center justify-between p-3 bg-navy-700 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                        @if($transaction['icon'] === 'deposit') bg-green-500/20 text-green-400
                        @elseif($transaction['icon'] === 'investment') bg-purple-500/20 text-purple-400
                        @elseif($transaction['icon'] === 'profit') bg-blue-500/20 text-blue-400
                        @elseif($transaction['icon'] === 'referral') bg-pink-500/20 text-pink-400
                        @elseif($transaction['icon'] === 'withdraw') bg-orange-500/20 text-orange-400
                        @else bg-gray-500/20 text-gray-400
                        @endif">
                        @if($transaction['icon'] === 'deposit')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        @elseif($transaction['icon'] === 'investment')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        @elseif($transaction['icon'] === 'profit')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        @elseif($transaction['icon'] === 'referral')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @elseif($transaction['icon'] === 'withdraw')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">{{ $transaction['type'] }}</p>
                        <p class="text-gray-400 text-xs">{{ $transaction['date'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-white font-semibold text-sm">
                        @if($transaction['icon'] === 'withdraw')
                        -${{ number_format($transaction['amount'], 2) }}
                        @else
                        +${{ number_format($transaction['amount'], 2) }}
                        @endif
                    </p>
                    <p class="text-xs
                        @if($transaction['status'] === 'Completed' || $transaction['status'] === 'Credited') text-green-400
                        @elseif($transaction['status'] === 'Processing') text-yellow-400
                        @elseif($transaction['status'] === 'Active') text-purple-400
                        @else text-gray-400
                        @endif">
                        {{ $transaction['status'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
