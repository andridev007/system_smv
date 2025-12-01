@extends('layouts.app')

@section('title', 'Referral')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-xl font-bold text-white">Referral Program</h1>
    </div>

    <!-- Referral Stats -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-gradient-to-r from-pink-600 to-rose-600 rounded-xl p-4 text-white">
            <p class="text-pink-100 text-sm mb-1">Total Referrals</p>
            <h2 class="text-3xl font-bold">{{ $total_referrals }}</h2>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl p-4 text-white">
            <p class="text-green-100 text-sm mb-1">Referral Earnings</p>
            <h2 class="text-3xl font-bold">$0.00</h2>
        </div>
    </div>

    <!-- Referral Link Card -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Your Referral Link</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-2">
                <input type="text" 
                       readonly 
                       value="{{ $referral_url }}" 
                       id="referral-link"
                       class="flex-1 bg-slate-700 text-slate-300 text-sm px-4 py-3 rounded-lg border border-slate-600 truncate">
                <button onclick="copyReferralLink()" 
                        id="copy-btn"
                        class="px-4 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition whitespace-nowrap">
                    Copy
                </button>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-slate-400 text-sm">Referral Code:</span>
                <span class="font-mono text-white bg-slate-700 px-3 py-1 rounded">{{ $referral_code }}</span>
            </div>
        </div>
    </div>

    <!-- Share Options -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Share Your Link</h3>
        <div class="grid grid-cols-4 gap-4">
            <!-- WhatsApp -->
            <a href="https://wa.me/?text={{ urlencode('Join SAMUVE Investment Platform using my referral link: ' . $referral_url) }}" 
               target="_blank"
               class="flex flex-col items-center gap-2 p-4 bg-green-500/10 rounded-xl hover:bg-green-500/20 transition">
                <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <span class="text-slate-300 text-xs">WhatsApp</span>
            </a>

            <!-- Telegram -->
            <a href="https://t.me/share/url?url={{ urlencode($referral_url) }}&text={{ urlencode('Join SAMUVE Investment Platform') }}" 
               target="_blank"
               class="flex flex-col items-center gap-2 p-4 bg-blue-500/10 rounded-xl hover:bg-blue-500/20 transition">
                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                    </svg>
                </div>
                <span class="text-slate-300 text-xs">Telegram</span>
            </a>

            <!-- Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($referral_url) }}" 
               target="_blank"
               class="flex flex-col items-center gap-2 p-4 bg-blue-600/10 rounded-xl hover:bg-blue-600/20 transition">
                <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </div>
                <span class="text-slate-300 text-xs">Facebook</span>
            </a>

            <!-- Twitter/X -->
            <a href="https://twitter.com/intent/tweet?text={{ urlencode('Join SAMUVE Investment Platform using my referral link: ' . $referral_url) }}" 
               target="_blank"
               class="flex flex-col items-center gap-2 p-4 bg-slate-600/10 rounded-xl hover:bg-slate-600/20 transition">
                <div class="w-12 h-12 rounded-full bg-slate-700 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </div>
                <span class="text-slate-300 text-xs">Twitter</span>
            </a>
        </div>
    </div>

    <!-- Downlines List -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Your Downlines</h3>
        
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
                        <p class="text-slate-400 text-sm">Joined {{ $downline['joined_date'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-green-400 font-semibold">+${{ number_format($downline['bonus_earned'], 2) }}</p>
                    <p class="text-slate-400 text-xs">Bonus Earned</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-slate-400 font-medium">No referrals yet</p>
            <p class="text-slate-500 text-sm mt-1">Share your referral link to invite friends</p>
        </div>
        @endif
    </div>

    <!-- How It Works -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">How Referral Works</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center p-4">
                <div class="w-12 h-12 rounded-full bg-pink-500/20 flex items-center justify-center mx-auto mb-3">
                    <span class="text-pink-400 font-bold text-xl">1</span>
                </div>
                <h4 class="text-white font-medium mb-2">Share Your Link</h4>
                <p class="text-slate-400 text-sm">Share your unique referral link with friends and family</p>
            </div>
            <div class="text-center p-4">
                <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center mx-auto mb-3">
                    <span class="text-purple-400 font-bold text-xl">2</span>
                </div>
                <h4 class="text-white font-medium mb-2">They Sign Up</h4>
                <p class="text-slate-400 text-sm">Your friend registers using your referral link</p>
            </div>
            <div class="text-center p-4">
                <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center mx-auto mb-3">
                    <span class="text-green-400 font-bold text-xl">3</span>
                </div>
                <h4 class="text-white font-medium mb-2">Earn Bonus</h4>
                <p class="text-slate-400 text-sm">You earn bonus when they make investments</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyReferralLink() {
        const input = document.getElementById('referral-link');
        const button = document.getElementById('copy-btn');
        
        input.select();
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value);
        
        // Show feedback
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        button.classList.remove('bg-pink-600', 'hover:bg-pink-700');
        button.classList.add('bg-green-600');
        
        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-pink-600', 'hover:bg-pink-700');
        }, 2000);
    }
</script>
@endpush
@endsection
