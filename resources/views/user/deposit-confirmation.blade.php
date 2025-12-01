@extends('layouts.app')

@section('title', 'Deposit Confirmation')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Deposit Confirmation</h1>
    </div>

    <!-- Success Alert -->
    <div class="bg-green-500/20 border border-green-500 rounded-xl p-4">
        <div class="flex items-start gap-3">
            <div class="p-2 bg-green-500/20 rounded-lg">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-medium text-white mb-1">Deposit Request Created</h3>
                <p class="text-sm text-slate-300">
                    Your deposit request has been created successfully. Please transfer the exact amount shown below.
                </p>
            </div>
        </div>
    </div>

    <!-- Deposit Details Card -->
    <div class="bg-slate-800 rounded-2xl p-6 space-y-6">
        <h2 class="text-lg font-semibold text-white">Transfer Details</h2>
        
        <div class="space-y-4">
            <!-- Amount Breakdown -->
            <div class="bg-slate-700/50 rounded-xl p-4 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Deposit Amount</span>
                    <span class="text-white font-medium">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Unique Code</span>
                    <span class="text-yellow-400 font-medium">+ Rp {{ number_format($deposit->unique_code, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-slate-600 pt-3">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-300 font-medium">Total Transfer</span>
                        <span class="text-green-400 text-xl font-bold">Rp {{ number_format($deposit->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="bg-yellow-500/10 border border-yellow-500/50 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-yellow-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-yellow-400 mb-1">Important</h3>
                        <p class="text-sm text-slate-300">
                            Please transfer <strong class="text-white">exactly Rp {{ number_format($deposit->total_amount, 0, ',', '.') }}</strong> to ensure automatic verification. 
                            The unique code helps us identify your transfer.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-slate-700/50 rounded-xl p-4">
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Payment Method</span>
                    <span class="text-white font-medium capitalize">{{ str_replace('_', ' ', $deposit->payment_method) }}</span>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-slate-700/50 rounded-xl p-4">
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Status</span>
                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/20 text-yellow-400">
                        Pending
                    </span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <a href="{{ route('user.deposit') }}" class="flex-1 bg-slate-700 hover:bg-slate-600 text-white font-semibold py-3 rounded-xl transition text-center">
                Make Another Deposit
            </a>
            <a href="{{ route('user.transactions') }}" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition text-center">
                View Transactions
            </a>
        </div>
    </div>
</div>
@endsection
