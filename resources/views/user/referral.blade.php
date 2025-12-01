@extends('layouts.app')

@section('title', 'Referral Program')

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
            <h1 class="text-2xl font-bold">Referral Program</h1>
            <p class="text-sm text-slate-400">Earn bonuses by inviting friends</p>
        </div>
    </div>

    <!-- Referral Stats Cards -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-gradient-to-r from-pink-600 to-rose-600 rounded-xl p-4 text-white">
            <p class="text-xs opacity-80 mb-1">Total Referrals</p>
            <p class="text-2xl font-bold">{{ count($referrals) }}</p>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl p-4 text-white">
            <p class="text-xs opacity-80 mb-1">Total Earnings</p>
            <p class="text-2xl font-bold">$0.00</p>
        </div>
    </div>

    <!-- Referral Link Card -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">Your Referral Link</h3>
        <p class="text-sm text-slate-400 mb-4">
            Share your unique referral link with friends and earn bonuses when they invest!
        </p>
        
        <div class="space-y-4">
            <!-- Referral Code -->
            <div>
                <label class="block text-sm text-slate-400 mb-2">Referral Code</label>
                <div class="bg-slate-700 rounded-xl px-4 py-3 font-mono text-lg text-center text-white">
                    {{ $referral_code }}
                </div>
            </div>

            <!-- Referral Link -->
            <div>
                <label class="block text-sm text-slate-400 mb-2">Referral Link</label>
                <div class="flex items-center gap-2">
                    <input 
                        type="text" 
                        readonly 
                        value="{{ $referral_link }}" 
                        id="referral-link"
                        class="flex-1 bg-slate-700 text-sm text-slate-300 px-4 py-3 rounded-xl border border-slate-600 truncate"
                    >
                    <button 
                        onclick="copyReferralLink(this)" 
                        class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-3 rounded-xl text-sm font-medium transition whitespace-nowrap"
                    >
                        Copy
                    </button>
                </div>
            </div>

            <!-- Share Buttons -->
            <div class="pt-4 border-t border-slate-700">
                <p class="text-sm text-slate-400 mb-3">Share via</p>
                <div class="flex gap-3">
                    <a href="https://wa.me/?text={{ urlencode('Join me on SAMUVE and start investing! Use my referral link: ' . $referral_link) }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span class="text-sm font-medium">WhatsApp</span>
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode($referral_link) }}&text={{ urlencode('Join me on SAMUVE and start investing!') }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                        <span class="text-sm font-medium">Telegram</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">How It Works</h3>
        <div class="space-y-4">
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 rounded-full bg-pink-600 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold">1</span>
                </div>
                <div>
                    <h4 class="font-medium text-white">Share Your Link</h4>
                    <p class="text-sm text-slate-400">Share your unique referral link with friends and family</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 rounded-full bg-pink-600 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold">2</span>
                </div>
                <div>
                    <h4 class="font-medium text-white">Friend Registers</h4>
                    <p class="text-sm text-slate-400">Your friend signs up using your referral link</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 rounded-full bg-pink-600 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold">3</span>
                </div>
                <div>
                    <h4 class="font-medium text-white">Earn Bonuses</h4>
                    <p class="text-sm text-slate-400">Get rewarded when your referral makes their first investment</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Referrals List -->
    <div class="bg-slate-800 rounded-2xl overflow-hidden">
        <div class="p-4 border-b border-slate-700">
            <h3 class="text-lg font-semibold">Your Referrals</h3>
        </div>
        
        @forelse($referrals as $referral)
        <div class="p-4 border-b border-slate-700 last:border-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                        <span class="text-sm font-semibold text-white">{{ substr($referral['name'], 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-white">{{ $referral['name'] }}</p>
                        <p class="text-xs text-slate-400">Joined {{ $referral['date'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($referral['status'] === 'Active') bg-green-500/20 text-green-400
                        @else bg-slate-500/20 text-slate-400
                        @endif">
                        {{ $referral['status'] }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center">
            <svg class="w-12 h-12 text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-slate-400 mb-2">No referrals yet</p>
            <p class="text-slate-500 text-sm">Start sharing your link to earn bonuses</p>
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
    function copyReferralLink(button) {
        const input = document.getElementById('referral-link');
        input.select();
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value);
        
        // Show feedback
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        setTimeout(() => {
            button.textContent = originalText;
        }, 2000);
    }
</script>
@endpush
@endsection
