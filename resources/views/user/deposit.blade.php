@extends('layouts.app')

@section('title', 'Deposit')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white">Deposit Funds</h1>
        <p class="text-slate-400 text-sm">Add funds to your account</p>
    </div>

    <!-- Deposit Form -->
    <div class="bg-slate-800 rounded-xl p-6">
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <!-- Amount Input -->
            <div>
                <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">Amount (USD)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg">$</span>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           min="10" 
                           step="0.01"
                           placeholder="0.00"
                           class="w-full bg-slate-700 text-white pl-10 pr-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <p class="text-xs text-slate-500 mt-2">Minimum deposit: $10.00</p>
            </div>

            <!-- Payment Method -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">Payment Method</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Bank Transfer Option -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="bank" class="peer hidden" checked>
                        <div class="p-4 bg-slate-700 rounded-lg border-2 border-slate-600 peer-checked:border-blue-500 peer-checked:bg-blue-500/10 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Bank Transfer</p>
                                    <p class="text-xs text-slate-400">Direct bank deposit</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Crypto Option -->
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="crypto" class="peer hidden">
                        <div class="p-4 bg-slate-700 rounded-lg border-2 border-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-500/10 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-orange-500/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">Cryptocurrency</p>
                                    <p class="text-xs text-slate-400">BTC, ETH, USDT</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                Continue to Payment
            </button>
        </form>
    </div>

    <!-- Deposit Info -->
    <div class="bg-slate-800/50 rounded-xl p-4">
        <h3 class="text-white font-semibold mb-3">Important Information</h3>
        <ul class="space-y-2 text-sm text-slate-400">
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Deposits are usually processed within 24 hours.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Cryptocurrency deposits require 3 network confirmations.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Contact support if your deposit is not reflected after 48 hours.</span>
            </li>
        </ul>
    </div>
</div>
@endsection
