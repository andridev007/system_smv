@extends('layouts.app')

@section('title', 'Deposit')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Deposit Funds</h1>
    </div>

    <!-- Deposit Form Card -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <!-- Amount Input -->
            <div>
                <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">
                    Amount (USD)
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
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl pl-8 pr-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        required
                    >
                </div>
                <p class="mt-2 text-xs text-slate-400">Minimum deposit: $10.00</p>
            </div>

            <!-- Payment Method Selection -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">
                    Payment Method
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Bitcoin -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="payment_method" value="bitcoin" class="peer sr-only" required>
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14.24 10.56c-.31 1.24-2.24.61-2.84.44l.55-2.18c.62.18 2.61.44 2.29 1.74zm-3.11 1.56l-.6 2.41c.74.19 3.03.92 3.37-.44.36-1.42-2.03-1.79-2.77-1.97zm10.57 2.3c-1.34 5.36-6.76 8.62-12.12 7.28S.96 14.94 2.3 9.58 9.06.96 14.42 2.3s8.62 6.76 7.28 12.12zm-7.49-6.37l.45-1.8-1.1-.25-.44 1.73c-.29-.07-.58-.14-.88-.2l.44-1.77-1.09-.26-.45 1.79c-.24-.06-.48-.11-.7-.17l-1.51-.38-.3 1.17s.82.19.8.2c.45.11.53.39.51.62l-.51 2.02c.03.01.07.02.11.04-.04-.01-.08-.02-.12-.03l-.71 2.83c-.05.14-.2.35-.51.27.01.01-.8-.2-.8-.2l-.55 1.26 1.42.35c.27.07.53.14.79.2l-.46 1.82 1.09.27.45-1.8c.3.08.59.15.88.22l-.45 1.78 1.1.27.45-1.82c1.85.35 3.24.21 3.82-1.46.47-1.34-.02-2.11-1-2.61.71-.17 1.24-.63 1.38-1.6.2-1.33-.82-2.04-2.21-2.52z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Bitcoin</p>
                                <p class="text-xs text-slate-400">BTC</p>
                            </div>
                            <div class="ml-auto">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:border-green-500 peer-checked:bg-green-500 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Ethereum -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="payment_method" value="ethereum" class="peer sr-only">
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 1.75l-6.25 10.5L12 16l6.25-3.75L12 1.75zM5.75 13.5L12 22.25l6.25-8.75L12 17.25l-6.25-3.75z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Ethereum</p>
                                <p class="text-xs text-slate-400">ETH</p>
                            </div>
                            <div class="ml-auto">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:border-green-500 peer-checked:bg-green-500 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- USDT TRC20 -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="payment_method" value="usdt_trc20" class="peer sr-only">
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center">
                                <span class="text-green-400 font-bold text-sm">₮</span>
                            </div>
                            <div>
                                <p class="font-medium text-white">USDT</p>
                                <p class="text-xs text-slate-400">TRC20</p>
                            </div>
                            <div class="ml-auto">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:border-green-500 peer-checked:bg-green-500 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Bank Transfer -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="payment_method" value="bank_transfer" class="peer sr-only">
                        <div class="flex items-center gap-3 p-4 bg-slate-700 border-2 border-slate-600 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-500/10 transition">
                            <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Bank Transfer</p>
                                <p class="text-xs text-slate-400">Local Bank</p>
                            </div>
                            <div class="ml-auto">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-500 peer-checked:border-green-500 peer-checked:bg-green-500 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-4 rounded-xl transition flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Proceed to Payment
            </button>
        </form>
    </div>

    <!-- Info Card -->
    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700">
        <div class="flex items-start gap-3">
            <div class="p-2 bg-blue-500/20 rounded-lg">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-white mb-1">Important Notice</h3>
                <p class="text-sm text-slate-400">
                    Deposits are processed instantly for cryptocurrency payments. Bank transfers may take 1-3 business days to reflect in your account.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
