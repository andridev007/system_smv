@extends('layouts.app')

@section('title', 'Withdraw')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Withdraw Funds</h1>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-orange-600 to-amber-600 rounded-2xl p-6 text-white">
        <p class="text-sm opacity-90 mb-1">Available Balance</p>
        <p class="text-3xl font-bold">${{ number_format($available_balance, 2) }}</p>
    </div>

    <!-- Withdraw Form Card -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <!-- Amount Input -->
            <div>
                <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">
                    Withdrawal Amount (USD)
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">$</span>
                    <input 
                        type="number" 
                        id="amount" 
                        name="amount" 
                        min="10" 
                        step="0.01"
                        placeholder="0.00"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        required
                    >
                </div>
                <p class="mt-2 text-xs text-slate-400">Minimum withdrawal: $10.00</p>
            </div>

            <!-- Withdrawal Method Selection -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">
                    Withdrawal Method
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Bitcoin -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="withdrawal_method" value="bitcoin" class="peer sr-only" required>
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14.24 10.56c-.31 1.24-2.24.61-2.84.44l.55-2.18c.62.18 2.61.44 2.29 1.74zm-3.11 1.56l-.6 2.41c.74.19 3.03.92 3.37-.44.36-1.42-2.03-1.79-2.77-1.97zm10.57 2.3c-1.34 5.36-6.76 8.62-12.12 7.28S.96 14.94 2.3 9.58 9.06.96 14.42 2.3s8.62 6.76 7.28 12.12zm-7.49-6.37l.45-1.8-1.1-.25-.44 1.73c-.29-.07-.58-.14-.88-.2l.44-1.77-1.09-.26-.45 1.79c-.24-.06-.48-.11-.7-.17l-1.51-.38-.3 1.17s.82.19.8.2c.45.11.53.39.51.62l-.51 2.02c.03.01.07.02.11.04-.04-.01-.08-.02-.12-.03l-.71 2.83c-.05.14-.2.35-.51.27.01.01-.8-.2-.8-.2l-.55 1.26 1.42.35c.27.07.53.14.79.2l-.46 1.82 1.09.27.45-1.8c.3.08.59.15.88.22l-.45 1.78 1.1.27.45-1.82c1.85.35 3.24.21 3.82-1.46.47-1.34-.02-2.11-1-2.61.71-.17 1.24-.63 1.38-1.6.2-1.33-.82-2.04-2.21-2.52z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Bitcoin</p>
                                <p class="text-xs text-slate-400">BTC</p>
                            </div>
                        </div>
                    </label>

                    <!-- USDT TRC20 -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="withdrawal_method" value="usdt_trc20" class="peer sr-only">
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center">
                                <span class="text-green-400 font-bold text-sm">₮</span>
                            </div>
                            <div>
                                <p class="font-medium text-white">USDT</p>
                                <p class="text-xs text-slate-400">TRC20</p>
                            </div>
                        </div>
                    </label>

                    <!-- Bank Transfer -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="withdrawal_method" value="bank_transfer" class="peer sr-only">
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Bank Transfer</p>
                                <p class="text-xs text-slate-400">Local Bank</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Wallet Address Input -->
            <div>
                <label for="wallet_address" class="block text-sm font-medium text-slate-300 mb-2">
                    Wallet Address / Account Number
                </label>
                <input 
                    type="text" 
                    id="wallet_address" 
                    name="wallet_address" 
                    placeholder="Enter your wallet address or account number"
                    class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    required
                >
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-4 rounded-xl transition flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Request Withdrawal
            </button>
        </form>
    </div>

    <!-- Info Card -->
    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700">
        <div class="flex items-start gap-3">
            <div class="p-2 bg-yellow-500/20 rounded-lg">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-white mb-1">Withdrawal Processing</h3>
                <p class="text-sm text-slate-400">
                    Cryptocurrency withdrawals are processed within 24 hours. Bank transfers may take 2-5 business days. Please ensure your wallet address or account details are correct.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
