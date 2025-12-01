@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-xl font-bold text-white">Settings</h1>
    </div>

    <!-- Profile Avatar -->
    <div class="bg-slate-800 rounded-xl p-6 text-center">
        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mx-auto mb-4">
            <span class="text-white text-3xl font-bold">{{ substr($user->name ?? 'U', 0, 1) }}</span>
        </div>
        <h2 class="text-xl font-semibold text-white">{{ $user->name ?? 'User' }}</h2>
        <p class="text-slate-400 text-sm">{{ $user->email ?? 'user@example.com' }}</p>
    </div>

    <!-- Profile Information Form -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Profile Information</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ $user->name ?? '' }}"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                       required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ $user->email ?? '' }}"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                       disabled>
                <p class="mt-1 text-xs text-slate-400">Email cannot be changed</p>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">Phone Number</label>
                <input type="tel" 
                       name="phone" 
                       id="phone" 
                       value="{{ $user->phone ?? '' }}"
                       placeholder="+62 xxx xxxx xxxx"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-slate-300 mb-2">Username</label>
                <input type="text" 
                       name="username" 
                       id="username" 
                       value="{{ $user->username ?? '' }}"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                       disabled>
                <p class="mt-1 text-xs text-slate-400">Username cannot be changed</p>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
                Update Profile
            </button>
        </form>
    </div>

    <!-- Bank Information -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Bank Information</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="bank_name" class="block text-sm font-medium text-slate-300 mb-2">Bank Name</label>
                <input type="text" 
                       name="bank_name" 
                       id="bank_name" 
                       value="{{ $user->bank_name ?? '' }}"
                       placeholder="e.g., BCA, Mandiri, BRI"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div>
                <label for="account_number" class="block text-sm font-medium text-slate-300 mb-2">Account Number</label>
                <input type="text" 
                       name="account_number" 
                       id="account_number" 
                       value="{{ $user->account_number ?? '' }}"
                       placeholder="Enter your bank account number"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <div>
                <label for="account_holder" class="block text-sm font-medium text-slate-300 mb-2">Account Holder Name</label>
                <input type="text" 
                       name="account_holder" 
                       id="account_holder" 
                       value="{{ $user->account_holder ?? '' }}"
                       placeholder="Enter the account holder name"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition">
            </div>

            <button type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition">
                Update Bank Information
            </button>
        </form>
    </div>

    <!-- Change Password Form -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Change Password</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="current_password" class="block text-sm font-medium text-slate-300 mb-2">Current Password</label>
                <input type="password" 
                       name="current_password" 
                       id="current_password" 
                       placeholder="Enter your current password"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                       required>
            </div>

            <div>
                <label for="new_password" class="block text-sm font-medium text-slate-300 mb-2">New Password</label>
                <input type="password" 
                       name="new_password" 
                       id="new_password" 
                       placeholder="Enter your new password"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                       required>
            </div>

            <div>
                <label for="confirm_password" class="block text-sm font-medium text-slate-300 mb-2">Confirm New Password</label>
                <input type="password" 
                       name="confirm_password" 
                       id="confirm_password" 
                       placeholder="Confirm your new password"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition"
                       required>
            </div>

            <button type="submit" 
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl transition">
                Change Password
            </button>
        </form>
    </div>

    <!-- Logout -->
    <div class="bg-slate-800 rounded-xl p-6">
        <form action="#" method="POST">
            @csrf
            <button type="submit" 
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
@endsection
