@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white">Account Settings</h1>
        <p class="text-slate-400 text-sm">Manage your profile and security settings</p>
    </div>

    <!-- Profile Section -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-white font-semibold mb-4">Profile Information</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <!-- Avatar -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <span class="text-2xl font-bold text-white">{{ substr($user->name ?? 'U', 0, 1) }}</span>
                </div>
                <div>
                    <p class="text-white font-medium">{{ $user->name ?? 'User' }}</p>
                    <p class="text-sm text-slate-400">{{ $user->email ?? 'user@example.com' }}</p>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ $user->name ?? '' }}"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Email (readonly) -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                <input type="email" 
                       id="email" 
                       value="{{ $user->email ?? '' }}"
                       readonly
                       class="w-full bg-slate-700/50 text-slate-400 px-4 py-3 rounded-lg border border-slate-600 cursor-not-allowed">
                <p class="text-xs text-slate-500 mt-1">Email cannot be changed.</p>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">Phone Number</label>
                <input type="tel" 
                       id="phone" 
                       name="phone" 
                       value="{{ $user->phone ?? '' }}"
                       placeholder="Enter your phone number"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                Update Profile
            </button>
        </form>
    </div>

    <!-- Password Section -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-white font-semibold mb-4">Change Password</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-slate-300 mb-2">Current Password</label>
                <input type="password" 
                       id="current_password" 
                       name="current_password" 
                       placeholder="Enter current password"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- New Password -->
            <div>
                <label for="new_password" class="block text-sm font-medium text-slate-300 mb-2">New Password</label>
                <input type="password" 
                       id="new_password" 
                       name="new_password" 
                       placeholder="Enter new password"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm New Password</label>
                <input type="password" 
                       id="new_password_confirmation" 
                       name="new_password_confirmation" 
                       placeholder="Confirm new password"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>

            <button type="submit" 
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition">
                Change Password
            </button>
        </form>
    </div>

    <!-- Security Info -->
    <div class="bg-slate-800/50 rounded-xl p-4">
        <h3 class="text-white font-semibold mb-3">Security Tips</h3>
        <ul class="space-y-2 text-sm text-slate-400">
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span>Use a strong password with at least 8 characters, including numbers and symbols.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span>Never share your password with anyone.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span>Change your password regularly for enhanced security.</span>
            </li>
        </ul>
    </div>
</div>
@endsection
