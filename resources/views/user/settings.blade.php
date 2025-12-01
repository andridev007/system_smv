@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold">Settings</h1>
            <p class="text-sm text-slate-400">Manage your account settings</p>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-6">Profile Information</h3>
        
        <form action="#" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Profile Picture -->
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <span class="text-2xl font-semibold text-white">{{ substr($user->name ?? 'U', 0, 1) }}</span>
                </div>
                <div>
                    <p class="text-sm text-slate-400 mb-2">Profile Photo</p>
                    <button type="button" class="text-sm text-purple-400 hover:text-purple-300 transition">
                        Change Photo
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-2">
                        Full Name
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ $user->name ?? '' }}"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-300 mb-2">
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ $user->username ?? '' }}"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ $user->email ?? '' }}"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">
                        Phone Number
                    </label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ $user->phone ?? '' }}"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>
            </div>

            <!-- Save Button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-xl transition"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-6">Change Password</h3>
        
        <form action="#" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password -->
                <div class="md:col-span-2">
                    <label for="current_password" class="block text-sm font-medium text-slate-300 mb-2">
                        Current Password
                    </label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        placeholder="Enter current password"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-slate-300 mb-2">
                        New Password
                    </label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        placeholder="Enter new password"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">
                        Confirm New Password
                    </label>
                    <input 
                        type="password" 
                        id="new_password_confirmation" 
                        name="new_password_confirmation" 
                        placeholder="Confirm new password"
                        class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>
            </div>

            <!-- Update Password Button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-xl transition"
                >
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Wallet Addresses Section -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-6">Withdrawal Addresses</h3>
        <p class="text-sm text-slate-400 mb-6">Save your wallet addresses for faster withdrawals</p>
        
        <form action="#" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Bitcoin Address -->
            <div>
                <label for="btc_address" class="block text-sm font-medium text-slate-300 mb-2">
                    Bitcoin (BTC) Address
                </label>
                <input 
                    type="text" 
                    id="btc_address" 
                    name="btc_address" 
                    placeholder="Enter your BTC wallet address"
                    class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent font-mono text-sm"
                >
            </div>

            <!-- USDT TRC20 Address -->
            <div>
                <label for="usdt_address" class="block text-sm font-medium text-slate-300 mb-2">
                    USDT (TRC20) Address
                </label>
                <input 
                    type="text" 
                    id="usdt_address" 
                    name="usdt_address" 
                    placeholder="Enter your USDT TRC20 wallet address"
                    class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent font-mono text-sm"
                >
            </div>

            <!-- Bank Details -->
            <div>
                <label for="bank_details" class="block text-sm font-medium text-slate-300 mb-2">
                    Bank Account Details
                </label>
                <textarea 
                    id="bank_details" 
                    name="bank_details" 
                    rows="3"
                    placeholder="Enter your bank account details (Bank Name, Account Number, Account Name)"
                    class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                ></textarea>
            </div>

            <!-- Save Addresses Button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-xl transition"
                >
                    Save Addresses
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-slate-800 rounded-2xl p-6 border border-red-500/30">
        <h3 class="text-lg font-semibold text-red-400 mb-2">Danger Zone</h3>
        <p class="text-sm text-slate-400 mb-4">
            Once you delete your account, there is no going back. Please be certain.
        </p>
        <button 
            type="button" 
            class="bg-red-600/20 hover:bg-red-600/30 text-red-400 border border-red-500/50 font-medium px-4 py-2 rounded-xl transition"
        >
            Delete Account
        </button>
    </div>
</div>
@endsection
