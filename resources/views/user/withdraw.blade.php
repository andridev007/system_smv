@extends('layouts.app')

@section('title', 'Withdraw')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white">Withdraw Funds</h1>
        <p class="text-slate-400 text-sm">Transfer funds to your wallet</p>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl p-6 text-white">
        <p class="text-sm opacity-90 mb-1">Available Balance</p>
        <p class="text-3xl font-bold">${{ number_format($available_balance, 2) }}</p>
    </div>

    <!-- Withdraw Form -->
    <div class="bg-slate-800 rounded-xl p-6">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <!-- Amount Input -->
            <div>
                <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">Withdrawal Amount (USD)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg">$</span>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           min="10" 
                           max="{{ $available_balance }}"
                           step="0.01"
                           placeholder="0.00"
                           class="w-full bg-slate-700 text-white pl-10 pr-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                </div>
                <p class="text-xs text-slate-500 mt-2">Minimum withdrawal: $10.00 | Fee: 2%</p>
            </div>

            <!-- Wallet Address -->
            <div>
                <label for="wallet" class="block text-sm font-medium text-slate-300 mb-2">Destination Wallet Address</label>
                <input type="text" 
                       id="wallet" 
                       name="wallet_address" 
                       placeholder="Enter your wallet address"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                <p class="text-xs text-slate-500 mt-2">Please double-check your wallet address before submitting.</p>
            </div>

            <!-- Wallet Type -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">Wallet Type</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="wallet_type" value="usdt_trc20" class="peer hidden" checked>
                        <div class="p-3 bg-slate-700 rounded-lg border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all text-center">
                            <p class="font-semibold text-white text-sm">USDT</p>
                            <p class="text-xs text-slate-400">TRC20</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="wallet_type" value="usdt_erc20" class="peer hidden">
                        <div class="p-3 bg-slate-700 rounded-lg border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all text-center">
                            <p class="font-semibold text-white text-sm">USDT</p>
                            <p class="text-xs text-slate-400">ERC20</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="wallet_type" value="btc" class="peer hidden">
                        <div class="p-3 bg-slate-700 rounded-lg border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all text-center">
                            <p class="font-semibold text-white text-sm">BTC</p>
                            <p class="text-xs text-slate-400">Bitcoin</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition">
                Request Withdrawal
            </button>
        </form>
    </div>

    <!-- Withdrawal Info -->
    <div class="bg-slate-800/50 rounded-xl p-4">
        <h3 class="text-white font-semibold mb-3">Withdrawal Policy</h3>
        <ul class="space-y-2 text-sm text-slate-400">
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-orange-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Withdrawals are processed within 24-48 hours.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-orange-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>A 2% processing fee applies to all withdrawals.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-orange-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Ensure your wallet address is correct. Wrong addresses cannot be recovered.</span>
            </li>
        </ul>
    </div>
</div>
@endsection
