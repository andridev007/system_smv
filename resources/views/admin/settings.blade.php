@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Admin Settings')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div>
        <p class="text-indigo-300">Configure system settings and preferences.</p>
    </div>

    <!-- Settings Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- General Settings -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                General Settings
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Site Name</label>
                    <input type="text" value="SAMUVE" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Support Email</label>
                    <input type="email" value="support@samuve.com" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Investment Settings -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                Investment Settings
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Minimum Deposit ($)</label>
                    <input type="number" value="50" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Minimum Withdrawal ($)</label>
                    <input type="number" value="20" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Referral Settings -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Referral Settings
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Referral Bonus (%)</label>
                    <input type="number" value="5" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="enable_referral" checked class="w-4 h-4 text-indigo-600 bg-indigo-800 border-indigo-700 rounded focus:ring-indigo-500">
                    <label for="enable_referral" class="text-sm text-indigo-300">Enable Referral Program</label>
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Payment Settings -->
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Payment Settings
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Bitcoin Wallet Address</label>
                    <input type="text" value="bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-mono text-sm">
                </div>
                <div>
                    <label class="block text-sm text-indigo-300 mb-2">Ethereum Wallet Address</label>
                    <input type="text" value="0x742d35Cc6634C0532925a3b844Bc9e7595f..." class="w-full bg-indigo-800/50 border border-indigo-700 rounded-lg px-4 py-2 text-white placeholder-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-mono text-sm">
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
