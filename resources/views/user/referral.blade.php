@extends('layouts.app')

@section('title', 'Referral')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white">Referral Program</h1>
        <p class="text-slate-400 text-sm">Invite friends and earn bonus rewards</p>
    </div>

    <!-- Referral Stats -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-gradient-to-br from-pink-600 to-rose-600 rounded-xl p-4 text-white">
            <p class="text-sm opacity-90 mb-1">Total Referrals</p>
            <p class="text-3xl font-bold">{{ $total_referrals }}</p>
        </div>
        <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl p-4 text-white">
            <p class="text-sm opacity-90 mb-1">Active Referrals</p>
            <p class="text-3xl font-bold">{{ collect($downlines)->where('status', 'Active')->count() }}</p>
        </div>
    </div>

    <!-- Referral Link Card -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-white font-semibold mb-3">Your Referral Link</h3>
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" 
                   readonly 
                   value="{{ $referral_url }}" 
                   id="referral-link"
                   class="flex-1 bg-slate-700 text-slate-300 text-sm px-4 py-3 rounded-lg border border-slate-600 truncate">
            <button onclick="copyReferralLink(this)" 
                    class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-semibold transition whitespace-nowrap">
                Copy Link
            </button>
        </div>
        <p class="text-xs text-slate-500 mt-3">Share this link with friends to earn referral bonuses.</p>
    </div>

    <!-- Referral Code -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-white font-semibold mb-3">Referral Code</h3>
        <div class="flex items-center gap-3">
            <div class="flex-1 bg-slate-700 text-center text-white text-2xl font-bold tracking-widest px-4 py-4 rounded-lg border border-slate-600">
                {{ $referral_code }}
            </div>
            <button onclick="copyReferralCode()" 
                    class="bg-slate-700 hover:bg-slate-600 text-white p-4 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Downlines List -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-white font-semibold mb-4">Your Downlines</h3>
        
        @if(count($downlines) > 0)
        <div class="space-y-3">
            @foreach($downlines as $downline)
            <div class="flex items-center justify-between p-4 bg-slate-700/50 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-semibold">{{ substr($downline['name'], 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-white font-medium">{{ $downline['name'] }}</p>
                        <p class="text-xs text-slate-400">{{ $downline['email'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-2 py-1 text-xs font-medium rounded-full
                        @if($downline['status'] === 'Active') bg-green-500/20 text-green-400
                        @else bg-slate-500/20 text-slate-400
                        @endif">
                        {{ $downline['status'] }}
                    </span>
                    <p class="text-xs text-slate-500 mt-1">Joined: {{ $downline['joined_date'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <svg class="w-12 h-12 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-slate-400">No referrals yet</p>
            <p class="text-sm text-slate-500 mt-1">Share your referral link to start earning!</p>
        </div>
        @endif
    </div>

    <!-- Referral Info -->
    <div class="bg-slate-800/50 rounded-xl p-4">
        <h3 class="text-white font-semibold mb-3">How It Works</h3>
        <ul class="space-y-2 text-sm text-slate-400">
            <li class="flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-pink-600 text-white text-xs flex items-center justify-center flex-shrink-0">1</span>
                <span>Share your referral link with friends and family.</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-pink-600 text-white text-xs flex items-center justify-center flex-shrink-0">2</span>
                <span>When they register and make their first deposit, you earn a bonus.</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-pink-600 text-white text-xs flex items-center justify-center flex-shrink-0">3</span>
                <span>Earn up to 5% commission on your referrals' investments.</span>
            </li>
        </ul>
    </div>
</div>

@push('scripts')
<script>
    function copyReferralLink(button) {
        const input = document.getElementById('referral-link');
        input.select();
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value);
        
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        setTimeout(() => {
            button.textContent = originalText;
        }, 2000);
    }

    function copyReferralCode() {
        navigator.clipboard.writeText('{{ $referral_code }}');
        alert('Referral code copied!');
    }
</script>
@endpush
@endsection
