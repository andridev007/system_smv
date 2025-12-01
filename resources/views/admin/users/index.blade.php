@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <p class="text-indigo-300">Manage all registered users in the system.</p>
        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">
            {{ $users->count() }} {{ Str::plural('user', $users->count()) }}
        </span>
    </div>

    <!-- Users Table -->
    <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-indigo-900/50">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">ID</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Name</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Email</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Referral Code</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Joined</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-indigo-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-800">
                    @forelse($users as $user)
                    <tr class="hover:bg-indigo-800/30 transition">
                        <td class="px-6 py-4 text-sm text-white">{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <span class="text-xs font-semibold text-white">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <span class="text-sm text-white">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-indigo-300">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-800 text-indigo-200 px-2 py-1 rounded text-xs font-mono">
                                {{ $user->referral_code ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-indigo-300">
                            {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded text-sm transition">
                                    View
                                </button>
                                <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1.5 rounded text-sm transition">
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-indigo-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-indigo-300">No users found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
