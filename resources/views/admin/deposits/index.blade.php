@extends('layouts.admin')

@section('title', 'Manage Deposits')
@section('page-title', 'Manage Deposits')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <p class="text-indigo-300">Review and manage all deposit requests.</p>
        <div class="flex items-center gap-2">
            <span class="bg-yellow-600 text-white px-3 py-1 rounded-full text-sm">
                {{ $deposits->where('status', 'pending')->count() }} Pending
            </span>
            <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">
                {{ $deposits->count() }} Total
            </span>
        </div>
    </div>

    <!-- Deposits Table -->
    <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-indigo-900/50">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">ID</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">User</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Amount</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Payment Method</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Status</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Date</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-800">
                    @forelse($deposits as $deposit)
                    <tr class="hover:bg-indigo-800/30 transition">
                        <td class="px-6 py-4 text-sm text-white">#{{ $deposit->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm text-white">{{ $deposit->user_name }}</span>
                                <span class="text-xs text-indigo-400">{{ $deposit->user_email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-green-400">${{ number_format($deposit->amount, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-800 text-indigo-200 px-2 py-1 rounded text-xs">
                                {{ $deposit->payment_method }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($deposit->status === 'pending')
                                <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded text-xs font-medium">
                                    Pending
                                </span>
                            @elseif($deposit->status === 'approved')
                                <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded text-xs font-medium">
                                    Approved
                                </span>
                            @else
                                <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded text-xs font-medium">
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-indigo-300">
                            {{ $deposit->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($deposit->status === 'pending')
                            <div class="flex items-center gap-2">
                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm transition">
                                    Approve
                                </button>
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-sm transition">
                                    Reject
                                </button>
                            </div>
                            @else
                            <span class="text-indigo-500 text-sm">No actions available</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-indigo-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="text-indigo-300">No deposits found</p>
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
            Approved
        </span>
        <span class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-red-500"></span>
            Rejected
        </span>
    </div>
</div>
@endsection
