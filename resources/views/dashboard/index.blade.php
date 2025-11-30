@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Welcome Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name ?? 'User' }}! 👋</h2>
        <p class="text-gray-400 mt-1">Here's an overview of your account</p>
    </div>

    <!-- Wallet Card -->
    <div class="bg-gradient-to-r from-purple-600 via-purple-500 to-blue-500 rounded-2xl p-6 shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Main Wallet -->
            <div class="space-y-2">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    <span class="text-purple-200 text-sm font-medium">Main Wallet</span>
                </div>
                <p class="text-3xl font-bold text-white">${{ number_format($balance, 2) }}</p>
                <p class="text-purple-200 text-sm">Available Balance</p>
            </div>
            <!-- Profit Wallet -->
            <div class="space-y-2 md:border-l md:border-purple-400/30 md:pl-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-purple-200 text-sm font-medium">Profit Wallet</span>
                </div>
                <p class="text-3xl font-bold text-white">${{ number_format($profit_balance, 2) }}</p>
                <p class="text-purple-200 text-sm">Total Earnings</p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="grid grid-cols-3 gap-4">
        <!-- Deposit Button -->
        <a href="#" class="flex flex-col items-center justify-center p-5 bg-gradient-to-br from-emerald-500/20 to-emerald-600/20 rounded-2xl border border-emerald-500/30 hover:border-emerald-400/50 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-emerald-500 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-emerald-400">Deposit</span>
        </a>

        <!-- Investment Button -->
        <a href="#" class="flex flex-col items-center justify-center p-5 bg-gradient-to-br from-purple-500/20 to-purple-600/20 rounded-2xl border border-purple-500/30 hover:border-purple-400/50 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-purple-500 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-purple-400">Investment</span>
        </a>

        <!-- Withdraw Button -->
        <a href="#" class="flex flex-col items-center justify-center p-5 bg-gradient-to-br from-orange-500/20 to-orange-600/20 rounded-2xl border border-orange-500/30 hover:border-orange-400/50 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-orange-500 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-orange-400">Withdraw</span>
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Deposit -->
        <div class="bg-navy-800 rounded-2xl p-5 border border-navy-700">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-white">${{ number_format($total_deposit, 2) }}</p>
            <p class="text-sm text-gray-400 mt-1">Total Deposit</p>
        </div>

        <!-- Total Investment -->
        <div class="bg-navy-800 rounded-2xl p-5 border border-navy-700">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-white">${{ number_format($total_investment, 2) }}</p>
            <p class="text-sm text-gray-400 mt-1">Total Investment</p>
        </div>

        <!-- Total Profit -->
        <div class="bg-navy-800 rounded-2xl p-5 border border-navy-700">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-white">${{ number_format($total_profit, 2) }}</p>
            <p class="text-sm text-gray-400 mt-1">Total Profit</p>
        </div>

        <!-- Referral Bonus -->
        <div class="bg-navy-800 rounded-2xl p-5 border border-navy-700">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-white">${{ number_format($referral_bonus, 2) }}</p>
            <p class="text-sm text-gray-400 mt-1">Referral Bonus</p>
        </div>
    </div>

    <!-- Referral Section -->
    <div class="bg-navy-800 rounded-2xl p-6 border border-navy-700">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Referral Link</h3>
            <span class="px-3 py-1 text-xs font-medium bg-purple-500/20 text-purple-400 rounded-full">Earn bonus</span>
        </div>
        <p class="text-sm text-gray-400 mb-4">Share your referral link and earn commission on every successful referral.</p>
        <div class="flex items-center space-x-3">
            <div class="flex-1 bg-navy-900 rounded-xl px-4 py-3 border border-navy-700 overflow-hidden">
                <p id="referral-link" class="text-sm text-gray-300 truncate">{{ $referral_link }}</p>
            </div>
            <button onclick="copyReferralLink()" class="px-5 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-xl transition-colors flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <span>Copy</span>
            </button>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-navy-800 rounded-2xl border border-navy-700 overflow-hidden">
        <div class="p-6 border-b border-navy-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Recent Transactions</h3>
                <a href="#" class="text-sm text-purple-400 hover:text-purple-300 font-medium">View All</a>
            </div>
        </div>
        <div class="divide-y divide-navy-700">
            @forelse($recent_transactions as $transaction)
                <div class="p-4 flex items-center justify-between hover:bg-navy-700/50 transition-colors">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-xl {{ $transaction['type'] == 'deposit' ? 'bg-emerald-500/20' : ($transaction['type'] == 'withdrawal' ? 'bg-red-500/20' : 'bg-purple-500/20') }} flex items-center justify-center">
                            @if($transaction['type'] == 'deposit')
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            @elseif($transaction['type'] == 'withdrawal')
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-white">{{ $transaction['description'] }}</p>
                            <p class="text-sm text-gray-400">{{ $transaction['date'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold {{ $transaction['type'] == 'withdrawal' ? 'text-red-400' : 'text-emerald-400' }}">
                            {{ $transaction['type'] == 'withdrawal' ? '-' : '+' }}${{ number_format($transaction['amount'], 2) }}
                        </p>
                        <p class="text-xs text-gray-400 capitalize">{{ $transaction['status'] }}</p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <div class="w-16 h-16 rounded-full bg-navy-700 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-gray-400">No transactions yet</p>
                    <p class="text-sm text-gray-500 mt-1">Your recent transactions will appear here</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function copyReferralLink() {
        const link = document.getElementById('referral-link').innerText;
        const button = document.querySelector('[onclick="copyReferralLink()"]');
        const originalContent = button.innerHTML;
        
        navigator.clipboard.writeText(link).then(() => {
            // Show success state on button
            button.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span>Copied!</span>';
            button.classList.remove('bg-purple-600', 'hover:bg-purple-700');
            button.classList.add('bg-emerald-600');
            
            // Restore original state after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalContent;
                button.classList.remove('bg-emerald-600');
                button.classList.add('bg-purple-600', 'hover:bg-purple-700');
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
</script>
@endsection
