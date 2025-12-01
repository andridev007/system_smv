@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Manage Users</h1>
            <p class="text-sm text-slate-400 mt-1">View and manage all registered users</p>
        </div>
        <div class="text-sm text-slate-400">
            Total: {{ number_format($users->total()) }} users
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-slate-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Balance</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-300">#{{ $user->id }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-white">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $user->username ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">{{ $user->email }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="text-sm text-white">${{ number_format($user->balance ?? 0, 2) }}</div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            @php
                                $isActive = $user->is_active ?? true;
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isActive ? 'bg-green-600/20 text-green-400' : 'bg-red-600/20 text-red-400' }}">
                                {{ $isActive ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-400">
                            {{ $user->created_at ? $user->created_at->format('M j, Y') : 'N/A' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center">
                            <div class="text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-sm">No users found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-5 py-4 border-t border-slate-700">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
