@extends('layouts.admin')

@section('title', 'Manage Withdrawals')
@section('page-title', 'Manage Withdrawals')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <p class="text-indigo-300">Review and process withdrawal requests.</p>
        <div class="flex items-center gap-2">
            <span class="bg-yellow-600 text-white px-3 py-1 rounded-full text-sm">
                {{ $withdrawals->where('status', 'pending')->count() }} Pending
            </span>
            <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">
                {{ $withdrawals->count() }} Total
            </span>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-indigo-900/50">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">ID</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">User</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Amount</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Wallet Address</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Status</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Date</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-800">
                    @forelse($withdrawals as $withdrawal)
                    <tr class="hover:bg-indigo-800/30 transition">
                        <td class="px-6 py-4 text-sm text-white">#{{ $withdrawal->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm text-white">{{ $withdrawal->user_name }}</span>
                                <span class="text-xs text-indigo-400">{{ $withdrawal->user_email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-orange-400">${{ number_format($withdrawal->amount, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-800 text-indigo-200 px-2 py-1 rounded text-xs font-mono truncate max-w-[200px] block">
                                {{ $withdrawal->wallet_address }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($withdrawal->status === 'pending')
                                <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded text-xs font-medium">
                                    Pending
                                </span>
                            @else
                                <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded text-xs font-medium">
                                    Processed
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-indigo-300">
                            {{ $withdrawal->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($withdrawal->status === 'pending')
                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm transition">
                                Approve
                            </button>
                            @else
                            <span class="text-indigo-500 text-sm">Completed</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-indigo-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-indigo-300">No withdrawals found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Legend -->
    <div class="flex items-center gap-4 text-sm text-indigo-300">
        <span class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
            Pending
        </span>
        <span class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-green-500"></span>
            Processed
        </span>
    </div>
</div>
@endsection
