@extends('layouts.app')

@section('title', 'Withdraw')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-xl font-bold text-white">Withdraw Funds</h1>
    </div>

    <!-- Available Balance Card -->
    <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl p-6 text-white">
        <p class="text-orange-100 text-sm mb-1">Available Balance</p>
        <h2 class="text-3xl font-bold">${{ number_format($available_balance, 2) }}</h2>
    </div>

    <!-- Withdraw Form -->
    <div class="bg-slate-800 rounded-xl p-6">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <!-- Amount Input -->
            <div>
                <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">
                    Withdrawal Amount (USD)
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">$</span>
                    <input type="number" 
                           name="amount" 
                           id="amount" 
                           min="10" 
                           step="0.01"
                           max="{{ $available_balance }}"
                           placeholder="0.00"
                           class="w-full bg-slate-700 text-white pl-8 pr-4 py-3 rounded-lg border border-slate-600 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 focus:outline-none transition"
                           required>
                </div>
                <p class="mt-2 text-xs text-slate-400">Minimum withdrawal: $10.00</p>
            </div>

            <!-- Wallet Address / Destination -->
            <div>
                <label for="wallet_address" class="block text-sm font-medium text-slate-300 mb-2">
                    Destination Wallet Address
                </label>
                <input type="text" 
                       name="wallet_address" 
                       id="wallet_address" 
                       placeholder="Enter your wallet address (USDT TRC20)"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 focus:outline-none transition"
                       required>
                <p class="mt-2 text-xs text-slate-400">Please ensure the wallet address is correct. Transactions cannot be reversed.</p>
            </div>

            <!-- Network Selection -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">
                    Select Network
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="network" value="trc20" class="peer hidden" checked required>
                        <div class="flex items-center justify-center p-3 bg-slate-700 rounded-xl border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition">
                            <span class="font-medium text-white text-sm">TRC20 (USDT)</span>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" name="network" value="erc20" class="peer hidden">
                        <div class="flex items-center justify-center p-3 bg-slate-700 rounded-xl border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition">
                            <span class="font-medium text-white text-sm">ERC20 (ETH)</span>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" name="network" value="bep20" class="peer hidden">
                        <div class="flex items-center justify-center p-3 bg-slate-700 rounded-xl border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition">
                            <span class="font-medium text-white text-sm">BEP20 (BSC)</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-xl transition">
                Request Withdrawal
            </button>
        </form>
    </div>

    <!-- Withdrawal Info -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Withdrawal Information</h3>
        <div class="space-y-4">
            <div class="flex items-start gap-3 p-4 bg-slate-700/50 rounded-lg">
                <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div class="text-sm text-slate-300">
                    <p class="font-medium text-yellow-400 mb-1">Processing Time</p>
                    <p>Withdrawals are typically processed within 24-48 hours.</p>
                </div>
            </div>

            <div class="flex items-start gap-3 p-4 bg-slate-700/50 rounded-lg">
                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm text-slate-300">
                    <p class="font-medium text-blue-400 mb-1">Fees</p>
                    <p>Network fees may apply depending on the selected network.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
