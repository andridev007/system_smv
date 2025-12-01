@extends('layouts.app')

@section('title', 'Transaction History')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold">Transaction History</h1>
            <p class="text-sm text-slate-400">View all your transactions</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 overflow-x-auto pb-2">
        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium whitespace-nowrap">
            All
        </button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 hover:bg-slate-700 rounded-lg text-sm font-medium whitespace-nowrap transition">
            Deposits
        </button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 hover:bg-slate-700 rounded-lg text-sm font-medium whitespace-nowrap transition">
            Withdrawals
        </button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 hover:bg-slate-700 rounded-lg text-sm font-medium whitespace-nowrap transition">
            Investments
        </button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 hover:bg-slate-700 rounded-lg text-sm font-medium whitespace-nowrap transition">
            Profits
        </button>
    </div>

    <!-- Transactions Table Card -->
    <div class="bg-slate-800 rounded-2xl overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th class="text-left text-xs font-medium text-slate-400 uppercase tracking-wider px-6 py-4">
                            Type
                        </th>
                        <th class="text-left text-xs font-medium text-slate-400 uppercase tracking-wider px-6 py-4">
                            Amount
                        </th>
                        <th class="text-left text-xs font-medium text-slate-400 uppercase tracking-wider px-6 py-4">
                            Status
                        </th>
                        <th class="text-left text-xs font-medium text-slate-400 uppercase tracking-wider px-6 py-4">
                            Date
                        </th>
                        <th class="text-left text-xs font-medium text-slate-400 uppercase tracking-wider px-6 py-4">
                            Reference
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-slate-700/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center
                                    @if($transaction['type'] === 'Deposit') bg-green-500/20 text-green-400
                                    @elseif($transaction['type'] === 'Withdrawal') bg-orange-500/20 text-orange-400
                                    @elseif($transaction['type'] === 'Investment') bg-purple-500/20 text-purple-400
                                    @else bg-blue-500/20 text-blue-400
                                    @endif">
                                    @if($transaction['type'] === 'Deposit')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    @elseif($transaction['type'] === 'Withdrawal')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    @elseif($transaction['type'] === 'Investment')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </div>
                                <span class="font-medium text-white">{{ $transaction['type'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold {{ $transaction['type'] === 'Withdrawal' ? 'text-red-400' : 'text-green-400' }}">
                                {{ $transaction['type'] === 'Withdrawal' ? '-' : '+' }}${{ number_format($transaction['amount'], 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($transaction['status'] === 'Completed') bg-green-500/20 text-green-400
                                @elseif($transaction['status'] === 'Pending') bg-yellow-500/20 text-yellow-400
                                @elseif($transaction['status'] === 'Processing') bg-blue-500/20 text-blue-400
                                @else bg-red-500/20 text-red-400
                                @endif">
                                {{ $transaction['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-sm">
                            {{ $transaction['date'] }}
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-sm font-mono">
                            {{ $transaction['reference'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="text-slate-400 mb-2">No transactions yet</p>
                                <p class="text-slate-500 text-sm">Your transaction history will appear here</p>
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
                            @if($transaction['type'] === 'Deposit') bg-green-500/20 text-green-400
                            @elseif($transaction['type'] === 'Withdrawal') bg-orange-500/20 text-orange-400
                            @elseif($transaction['type'] === 'Investment') bg-purple-500/20 text-purple-400
                            @else bg-blue-500/20 text-blue-400
                            @endif">
                            @if($transaction['type'] === 'Deposit')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            @elseif($transaction['type'] === 'Withdrawal')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @elseif($transaction['type'] === 'Investment')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-white">{{ $transaction['type'] }}</p>
                            <p class="text-xs text-slate-400">{{ $transaction['date'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold {{ $transaction['type'] === 'Withdrawal' ? 'text-red-400' : 'text-green-400' }}">
                            {{ $transaction['type'] === 'Withdrawal' ? '-' : '+' }}${{ number_format($transaction['amount'], 2) }}
                        </p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                            @if($transaction['status'] === 'Completed') bg-green-500/20 text-green-400
                            @elseif($transaction['status'] === 'Pending') bg-yellow-500/20 text-yellow-400
                            @elseif($transaction['status'] === 'Processing') bg-blue-500/20 text-blue-400
                            @else bg-red-500/20 text-red-400
                            @endif">
                            {{ $transaction['status'] }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <svg class="w-12 h-12 text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="text-slate-400 mb-2">No transactions yet</p>
                <p class="text-slate-500 text-sm">Your transaction history will appear here</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
