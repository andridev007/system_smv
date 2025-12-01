@extends('layouts.app')

@section('title', 'Deposit Confirmation')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('user.deposit') }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Deposit Confirmation</h1>
    </div>

    @if(session('success'))
    <div class="p-4 bg-green-500/20 border border-green-500 rounded-xl">
        <p class="text-green-400">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Deposit Details Card -->
    <div class="bg-slate-800 rounded-2xl p-6 space-y-6">
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-yellow-500/20 flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-white mb-2">Pending Deposit</h2>
            <p class="text-slate-400 text-sm">Please transfer the exact amount below</p>
        </div>

        <!-- Amount Details -->
        <div class="bg-slate-700/50 rounded-xl p-4 space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Deposit Amount</span>
                <span class="text-white font-medium">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Unique Code</span>
                <span class="text-white font-medium">+ Rp {{ number_format($deposit->unique_code, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-slate-600 pt-3 flex justify-between items-center">
                <span class="text-slate-300 font-medium">Total Transfer</span>
                <span class="text-green-400 font-bold text-xl">Rp {{ number_format($deposit->amount_total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="bg-yellow-500/10 border border-yellow-500/50 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <div class="p-1.5 bg-yellow-500/20 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-yellow-400 mb-1">Important!</h3>
                    <p class="text-sm text-yellow-300/80">
                        Please transfer the <strong>exact amount</strong> of <strong>Rp {{ number_format($deposit->amount_total, 0, ',', '.') }}</strong> to ensure automatic verification. Any difference in the amount may result in delayed processing.
                    </p>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="bg-slate-700/50 rounded-xl p-4">
            <h3 class="text-sm font-medium text-slate-400 mb-2">Payment Method</h3>
            <p class="text-white font-medium capitalize">{{ str_replace('_', ' ', $deposit->payment_method) }}</p>
        </div>

        <!-- Status -->
        <div class="bg-slate-700/50 rounded-xl p-4">
            <h3 class="text-sm font-medium text-slate-400 mb-2">Status</h3>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                @if($deposit->status === 'pending') bg-yellow-500/20 text-yellow-400
                @elseif($deposit->status === 'approved') bg-green-500/20 text-green-400
                @else bg-red-500/20 text-red-400
                @endif">
                {{ ucfirst($deposit->status) }}
            </span>
        </div>

        <!-- Back to Dashboard -->
        <a href="{{ route('dashboard') }}" class="w-full bg-slate-700 hover:bg-slate-600 text-white font-semibold py-4 rounded-xl transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
</div>
@endsection
