@extends('layouts.admin')

@section('title', 'Withdrawals')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Withdrawal Requests</h1>
            <p class="text-sm text-slate-400 mt-1">Manage pending and completed withdrawal requests</p>
        </div>
        <!-- Filter Tabs -->
        <div class="flex gap-2">
            <button class="px-4 py-2 text-sm font-medium rounded-lg bg-red-600 text-white">All</button>
            <button class="px-4 py-2 text-sm font-medium rounded-lg bg-slate-700 text-slate-300 hover:bg-slate-600 transition">Pending</button>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="bg-[#111827] rounded-xl border border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Method</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($withdrawals as $withdrawal)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-300">#{{ $withdrawal->id ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                                        <span class="text-xs font-semibold text-white">{{ substr($withdrawal->user->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-white">{{ $withdrawal->user->name ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-orange-400">${{ number_format($withdrawal->amount ?? 0, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-300">{{ $withdrawal->method ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-400 font-mono truncate max-w-[120px] block">{{ $withdrawal->address ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-300">{{ $withdrawal->created_at ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(($withdrawal->status ?? 'pending') === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500/20 text-yellow-400">
                                        Pending
                                    </span>
                                @elseif(($withdrawal->status ?? '') === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-400">
                                        Approved
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-400">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if(($withdrawal->status ?? 'pending') === 'pending')
                                    <button class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded transition mr-2">
                                        Approve
                                    </button>
                                    <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition">
                                        Reject
                                    </button>
                                @else
                                    <span class="text-slate-500 text-xs">No actions available</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <svg class="w-12 h-12 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-slate-400 text-sm">No withdrawal requests found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
