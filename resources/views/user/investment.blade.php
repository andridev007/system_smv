@extends('layouts.app')

@section('title', 'Investment Plans')

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
            <h1 class="text-2xl font-bold">Investment Plans</h1>
            <p class="text-sm text-slate-400">Choose a plan that suits your goals</p>
        </div>
    </div>

    <!-- Investment Plans Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($plans as $plan)
        <div class="bg-slate-800 rounded-2xl overflow-hidden border border-slate-700 hover:border-purple-500/50 transition">
            <!-- Plan Header -->
            <div class="p-6 {{ $plan['type'] === 'daily' ? 'bg-gradient-to-r from-blue-600 to-cyan-600' : 'bg-gradient-to-r from-purple-600 to-pink-600' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $plan['name'] }}</h3>
                        <p class="text-sm text-white/80">{{ $plan['duration'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        @if($plan['type'] === 'daily')
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        @else
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        @endif
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-bold text-white">{{ $plan['roi_percentage'] }}%</span>
                    <span class="text-white/80 text-sm">/ day</span>
                </div>
            </div>

            <!-- Plan Details -->
            <div class="p-6 space-y-4">
                <p class="text-slate-400 text-sm">{{ $plan['description'] }}</p>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between py-2 border-b border-slate-700">
                        <span class="text-slate-400 text-sm">Minimum Investment</span>
                        <span class="text-white font-semibold">${{ number_format($plan['min_amount'], 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-slate-700">
                        <span class="text-slate-400 text-sm">Maximum Investment</span>
                        <span class="text-white font-semibold">${{ number_format($plan['max_amount'], 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-slate-700">
                        <span class="text-slate-400 text-sm">Daily Return</span>
                        <span class="text-green-400 font-semibold">{{ $plan['roi_percentage'] }}%</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-slate-400 text-sm">Duration</span>
                        <span class="text-white font-semibold">{{ $plan['duration'] }}</span>
                    </div>
                </div>

                <!-- Invest Button -->
                <button 
                    type="button"
                    class="w-full {{ $plan['type'] === 'daily' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-purple-600 hover:bg-purple-700' }} text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Invest Now
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Features Section -->
    <div class="bg-slate-800 rounded-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">Why Invest With Us?</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-green-500/20 rounded-lg">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-white">Secure Platform</h4>
                    <p class="text-sm text-slate-400">Your investments are protected with advanced security</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="p-2 bg-blue-500/20 rounded-lg">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-white">Instant Processing</h4>
                    <p class="text-sm text-slate-400">Quick deposit and withdrawal processing</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="p-2 bg-purple-500/20 rounded-lg">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-white">24/7 Support</h4>
                    <p class="text-sm text-slate-400">Our team is always here to help you</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
