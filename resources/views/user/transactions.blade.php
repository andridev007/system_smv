@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Transaction History</h1>
            <p class="text-slate-400 text-sm">View all your deposits, investments, and withdrawals</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 overflow-x-auto pb-2">
        <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg whitespace-nowrap">
            All
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 whitespace-nowrap">
            Deposits
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 whitespace-nowrap">
            Investments
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 whitespace-nowrap">
            Withdrawals
        </button>
        <button class="px-4 py-2 bg-slate-700 text-slate-300 text-sm font-medium rounded-lg hover:bg-slate-600 whitespace-nowrap">
            Profits
        </button>
    </div>

    <!-- Transactions Table (Desktop) -->
    <div class="hidden md:block bg-slate-800 rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-700/50">
                <tr>
                    <th class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wider px-6 py-4">ID</th>
                    <th class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wider px-6 py-4">Type</th>
                    <th class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wider px-6 py-4">Amount</th>
                    <th class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wider px-6 py-4">Status</th>
                    <th class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wider px-6 py-4">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($transactions as $transaction)
                <tr class="hover:bg-slate-700/30">
                    <td class="px-6 py-4 text-sm text-slate-300">#{{ $transaction['id'] }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-2 text-sm font-medium
                            @if($transaction['type'] === 'Deposit') text-green-400
                            @elseif($transaction['type'] === 'Investment') text-purple-400
                            @elseif($transaction['type'] === 'Profit') text-blue-400
                            @elseif($transaction['type'] === 'Withdrawal') text-orange-400
                            @else text-slate-300
                            @endif">
                            @if($transaction['type'] === 'Deposit')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            @elseif($transaction['type'] === 'Investment')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            @elseif($transaction['type'] === 'Profit')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @elseif($transaction['type'] === 'Withdrawal')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @endif
                            {{ $transaction['type'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold
                        @if($transaction['type'] === 'Withdrawal') text-orange-400 @else text-green-400 @endif">
                        @if($transaction['type'] === 'Withdrawal')
                        -${{ number_format($transaction['amount'], 2) }}
                        @else
                        +${{ number_format($transaction['amount'], 2) }}
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($transaction['status'] === 'Completed' || $transaction['status'] === 'Credited') bg-green-500/20 text-green-400
                            @elseif($transaction['status'] === 'Processing') bg-yellow-500/20 text-yellow-400
                            @elseif($transaction['status'] === 'Active') bg-purple-500/20 text-purple-400
                            @elseif($transaction['status'] === 'Pending') bg-blue-500/20 text-blue-400
                            @else bg-slate-500/20 text-slate-400
                            @endif">
                            {{ $transaction['status'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-400">{{ $transaction['date'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg class="w-12 h-12 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="text-slate-400">No transactions found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Transactions Cards (Mobile) -->
    <div class="md:hidden space-y-3">
        @forelse($transactions as $transaction)
        <div class="bg-slate-800 rounded-xl p-4">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-slate-400">#{{ $transaction['id'] }}</span>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                    @if($transaction['status'] === 'Completed' || $transaction['status'] === 'Credited') bg-green-500/20 text-green-400
                    @elseif($transaction['status'] === 'Processing') bg-yellow-500/20 text-yellow-400
                    @elseif($transaction['status'] === 'Active') bg-purple-500/20 text-purple-400
                    @elseif($transaction['status'] === 'Pending') bg-blue-500/20 text-blue-400
                    @else bg-slate-500/20 text-slate-400
                    @endif">
                    {{ $transaction['status'] }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                        @if($transaction['type'] === 'Deposit') bg-green-500/20 text-green-400
                        @elseif($transaction['type'] === 'Investment') bg-purple-500/20 text-purple-400
                        @elseif($transaction['type'] === 'Profit') bg-blue-500/20 text-blue-400
                        @elseif($transaction['type'] === 'Withdrawal') bg-orange-500/20 text-orange-400
                        @else bg-slate-500/20 text-slate-400
                        @endif">
                        @if($transaction['type'] === 'Deposit')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        @elseif($transaction['type'] === 'Investment')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        @elseif($transaction['type'] === 'Profit')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        @elseif($transaction['type'] === 'Withdrawal')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-white font-medium">{{ $transaction['type'] }}</p>
                        <p class="text-xs text-slate-400">{{ $transaction['date'] }}</p>
                    </div>
                </div>
                <p class="font-semibold
                    @if($transaction['type'] === 'Withdrawal') text-orange-400 @else text-green-400 @endif">
                    @if($transaction['type'] === 'Withdrawal')
                    -${{ number_format($transaction['amount'], 2) }}
                    @else
                    +${{ number_format($transaction['amount'], 2) }}
                    @endif
                </p>
            </div>
        </div>
        @empty
        <div class="bg-slate-800 rounded-xl p-8 text-center">
            <svg class="w-12 h-12 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <p class="text-slate-400">No transactions found</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
