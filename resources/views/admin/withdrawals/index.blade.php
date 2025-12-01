@extends('layouts.admin')

@section('title', 'Manage Withdrawals')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Manage Withdrawals</h1>
            <p class="text-sm text-slate-400 mt-1">Review and process withdrawal requests</p>
        </div>
        <div class="text-sm text-slate-400">
            Total: {{ number_format($withdrawals->total()) }} withdrawals
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="bg-green-600/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-600/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <!-- Withdrawals Table -->
    <div class="bg-slate-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Source</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Net Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($withdrawals as $withdrawal)
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-300">#{{ $withdrawal->id }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-white">{{ substr($withdrawal->user->name ?? 'U', 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">{{ $withdrawal->user->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-slate-400">{{ $withdrawal->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @php
                                $sourceColors = [
                                    'investment' => 'bg-blue-600/20 text-blue-400',
                                    'share_profit' => 'bg-purple-600/20 text-purple-400',
                                    'bonus' => 'bg-pink-600/20 text-pink-400',
                                    'dream_consortium' => 'bg-indigo-600/20 text-indigo-400',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sourceColors[$withdrawal->source] ?? 'bg-slate-600/20 text-slate-400' }}">
                                {{ ucfirst(str_replace('_', ' ', $withdrawal->source ?? 'Unknown')) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-white font-medium">${{ number_format($withdrawal->amount, 2) }}</div>
                            @if($withdrawal->fee > 0)
                            <div class="text-xs text-slate-400">Fee: ${{ number_format($withdrawal->fee, 2) }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-green-400 font-medium">${{ number_format($withdrawal->net_amount ?? ($withdrawal->amount - ($withdrawal->fee ?? 0)), 2) }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-600/20 text-yellow-400',
                                    'approved' => 'bg-green-600/20 text-green-400',
                                    'rejected' => 'bg-red-600/20 text-red-400',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$withdrawal->status] ?? 'bg-slate-600/20 text-slate-400' }}">
                                {{ ucfirst($withdrawal->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-400">
                            {{ $withdrawal->created_at ? $withdrawal->created_at->format('M j, Y H:i') : 'N/A' }}
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @if($withdrawal->status === 'pending')
                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition" onclick="return confirm('Are you sure you want to approve and pay this withdrawal?')">
                                        Approve/Pay
                                    </button>
                                </form>
                                <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition" onclick="return confirm('Are you sure you want to reject this withdrawal?')">
                                        Reject
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-xs text-slate-500">No actions available</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-10 text-center">
                            <div class="text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-sm">No withdrawals found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($withdrawals->hasPages())
        <div class="px-5 py-4 border-t border-slate-700">
            {{ $withdrawals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
