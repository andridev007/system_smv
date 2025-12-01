@extends('layouts.admin')

@section('title', 'Manage Deposits')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Manage Deposits</h1>
            <p class="text-sm text-slate-400 mt-1">Review and approve deposit requests</p>
        </div>
        <div class="text-sm text-slate-400">
            Total: {{ number_format($deposits->total()) }} deposits
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

    <!-- Deposits Table -->
    <div class="bg-slate-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($deposits as $deposit)
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-300">#{{ $deposit->id }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-white">{{ substr($deposit->user->name ?? 'U', 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">{{ $deposit->user->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-slate-400">{{ $deposit->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-600/20 text-blue-400">
                                {{ ucfirst($deposit->type ?? 'Investment') }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-white font-medium">${{ number_format($deposit->amount, 2) }}</div>
                            @if($deposit->total_transfer)
                            <div class="text-xs text-slate-400">Total: ${{ number_format($deposit->total_transfer, 2) }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-600/20 text-yellow-400',
                                    'active' => 'bg-green-600/20 text-green-400',
                                    'approved' => 'bg-green-600/20 text-green-400',
                                    'rejected' => 'bg-red-600/20 text-red-400',
                                    'completed' => 'bg-blue-600/20 text-blue-400',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$deposit->status] ?? 'bg-slate-600/20 text-slate-400' }}">
                                {{ ucfirst($deposit->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-400">
                            {{ $deposit->created_at ? $deposit->created_at->format('M j, Y H:i') : 'N/A' }}
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @if($deposit->status === 'pending')
                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.deposits.approve', $deposit->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition" onclick="return confirm('Are you sure you want to approve this deposit?')">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.deposits.reject', $deposit->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition" onclick="return confirm('Are you sure you want to reject this deposit?')">
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
                        <td colspan="7" class="px-5 py-10 text-center">
                            <div class="text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="text-sm">No deposits found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($deposits->hasPages())
        <div class="px-5 py-4 border-t border-slate-700">
            {{ $deposits->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
