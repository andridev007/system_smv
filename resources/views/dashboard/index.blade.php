@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- All Wallets Card -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
        <h2 class="text-sm font-medium opacity-90 mb-4">All Wallets in USD</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs opacity-75">Main Wallet</p>
                <p class="text-2xl font-bold">${{ number_format($balance, 2) }}</p>
            </div>
            <div>
                <p class="text-xs opacity-75">Profit Wallet</p>
                <p class="text-2xl font-bold">${{ number_format($profit, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-3 gap-3">
        <a href="{{ route('user.deposit') }}" class="flex flex-col items-center justify-center bg-green-600 hover:bg-green-700 rounded-xl p-4 transition">
            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="text-sm font-medium">Deposit</span>
        </a>

        <a href="{{ route('user.investment') }}" class="flex flex-col items-center justify-center bg-purple-600 hover:bg-purple-700 rounded-xl p-4 transition">
            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            <span class="text-sm font-medium">Investment</span>
        </a>

        <a href="{{ route('user.withdraw') }}" class="flex flex-col items-center justify-center bg-orange-500 hover:bg-orange-600 rounded-xl p-4 transition">
            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-sm font-medium">Withdraw</span>
        </a>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Referral Link Box -->
        <div class="col-span-2 bg-slate-800 rounded-xl p-4">
            <p class="text-xs text-slate-400 mb-2">Your Referral Link</p>
            <div class="flex items-center gap-2">
                <input type="text" readonly value="{{ url('/register?ref=' . $referral_code) }}" 
                    id="referral-link"
                    class="flex-1 bg-slate-700 text-sm text-slate-300 px-3 py-2 rounded-lg border border-slate-600 truncate">
                <button onclick="copyReferralLink(this)" 
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Copy
                </button>
            </div>
        </div>

        <!-- Effective Balance -->
        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl p-4 text-white">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs font-medium">Effective Balance</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($effective_balance, 2) }}</p>
        </div>

        <!-- Remaining Share Profit -->
        <div class="bg-slate-800 rounded-xl p-4 text-cyan-400">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-xs font-medium text-slate-300">Remaining Share Profit</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($remaining_share_profit, 2) }}</p>
        </div>

        <!-- Total Deposit -->
        <div class="bg-yellow-500 rounded-xl p-4 text-slate-900">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-xs font-medium">Total Deposit</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($total_deposit, 2) }}</p>
        </div>

        <!-- Total Investment -->
        <div class="bg-purple-600 rounded-xl p-4 text-white">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span class="text-xs font-medium">Total Investment</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($total_invest, 2) }}</p>
        </div>

        <!-- Referral Bonus -->
        <div class="bg-gradient-to-r from-pink-600 to-rose-600 rounded-xl p-4 text-white">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="text-xs font-medium">Referral Bonus</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($referral_bonus, 2) }}</p>
        </div>

        <!-- Share Profit Bonus -->
        <div class="bg-slate-800 rounded-xl p-4 text-emerald-400">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                </svg>
                <span class="text-xs font-medium text-slate-300">Share Profit Bonus</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($share_profit_bonus, 2) }}</p>
        </div>

        <!-- Total Withdraw -->
        <div class="bg-slate-800 rounded-xl p-4 text-orange-400">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="text-xs font-medium text-slate-300">Total Withdraw</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($total_withdraw, 2) }}</p>
        </div>

        <!-- Remaining Bonus -->
        <div class="bg-slate-800 rounded-xl p-4 text-amber-400">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                <span class="text-xs font-medium text-slate-300">Remaining Bonus</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($remaining_bonus, 2) }}</p>
        </div>

        <!-- Total Profit -->
        <div class="bg-green-600 rounded-xl p-4 text-white">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs font-medium">Total Profit</span>
            </div>
            <p class="text-xl font-bold">${{ number_format($total_profit, 2) }}</p>
        </div>

        <!-- Withdraw Action Button -->
        <a href="{{ route('user.withdraw') }}" class="col-span-2 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 rounded-xl p-4 text-white flex items-center justify-center gap-3 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-lg font-semibold">Request Withdrawal</span>
        </a>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-slate-800 rounded-xl p-4">
        <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>
        
        <div class="space-y-3">
            <!-- Empty State -->
            <div class="text-center py-8 text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="text-sm">No transactions yet</p>
            </div>

            {{-- Sample Transaction Items (uncomment when data is available)
            <div class="flex items-center justify-between p-3 bg-slate-700/50 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Deposit</p>
                        <p class="text-xs text-slate-400">Dec 1, 2024</p>
                    </div>
                </div>
                <span class="text-green-400 font-semibold">+$100.00</span>
            </div>
            --}}
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyReferralLink(button) {
        const input = document.getElementById('referral-link');
        input.select();
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value);
        
        // Show feedback
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        setTimeout(() => {
            button.textContent = originalText;
        }, 2000);
    }
</script>
@endpush
@endsection
