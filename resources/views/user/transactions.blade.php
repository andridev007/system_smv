@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-white">Transaction History</h1>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 overflow-x-auto pb-2">
        <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg whitespace-nowrap">
            All
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 transition whitespace-nowrap">
            Deposits
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 transition whitespace-nowrap">
            Investments
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 transition whitespace-nowrap">
            Withdrawals
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 transition whitespace-nowrap">
            Bonuses
        </button>
    </div>

    <!-- Transactions Table -->
    <div class="bg-slate-800 rounded-xl overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Reference</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center
                                    @if($transaction['type'] === 'deposit') bg-green-500/20 text-green-400
                                    @elseif($transaction['type'] === 'investment') bg-purple-500/20 text-purple-400
                                    @elseif($transaction['type'] === 'withdraw') bg-orange-500/20 text-orange-400
                                    @elseif($transaction['type'] === 'profit') bg-blue-500/20 text-blue-400
                                    @else bg-pink-500/20 text-pink-400
                                    @endif">
                                    @if($transaction['type'] === 'deposit')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    @elseif($transaction['type'] === 'investment')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    @elseif($transaction['type'] === 'withdraw')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                    </svg>
                                    @endif
                                </div>
                                <span class="text-white font-medium capitalize">{{ $transaction['type'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="@if($transaction['type'] === 'withdraw') text-red-400 @else text-green-400 @endif font-semibold">
                                @if($transaction['type'] === 'withdraw')-@else+@endif${{ number_format($transaction['amount'], 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                @if($transaction['status'] === 'completed') bg-green-500/20 text-green-400
                                @elseif($transaction['status'] === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($transaction['status'] === 'processing') bg-blue-500/20 text-blue-400
                                @else bg-red-500/20 text-red-400
                                @endif">
                                {{ ucfirst($transaction['status']) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-sm">{{ $transaction['date'] }}</td>
                        <td class="px-6 py-4 text-slate-400 text-sm font-mono">{{ $transaction['reference'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="text-slate-400 font-medium">No transactions yet</p>
                                <p class="text-slate-500 text-sm mt-1">Your transaction history will appear here</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile List -->
        <div class="md:hidden divide-y divide-slate-700">
            @forelse($transactions as $transaction)
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center
                            @if($transaction['type'] === 'deposit') bg-green-500/20 text-green-400
                            @elseif($transaction['type'] === 'investment') bg-purple-500/20 text-purple-400
                            @elseif($transaction['type'] === 'withdraw') bg-orange-500/20 text-orange-400
                            @else bg-blue-500/20 text-blue-400
                            @endif">
                            @if($transaction['type'] === 'deposit')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            @elseif($transaction['type'] === 'investment')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-white font-medium capitalize">{{ $transaction['type'] }}</p>
                            <p class="text-slate-400 text-xs">{{ $transaction['date'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="@if($transaction['type'] === 'withdraw') text-red-400 @else text-green-400 @endif font-semibold">
                            @if($transaction['type'] === 'withdraw')-@else+@endif${{ number_format($transaction['amount'], 2) }}
                        </p>
                        <span class="text-xs
                            @if($transaction['status'] === 'completed') text-green-400
                            @elseif($transaction['status'] === 'pending') text-yellow-400
                            @else text-blue-400
                            @endif">
                            {{ ucfirst($transaction['status']) }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <svg class="w-12 h-12 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="text-slate-400 font-medium">No transactions yet</p>
                <p class="text-slate-500 text-sm mt-1">Your transaction history will appear here</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
