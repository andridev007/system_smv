@extends('layouts.app')

@section('title', 'Investment')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white">Investment Packages</h1>
        <p class="text-slate-400 text-sm">Choose an investment plan that suits your goals</p>
    </div>

    <!-- Investment Packages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($packages as $package)
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-purple-500 transition-colors">
            <!-- Package Header -->
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-white">{{ $package['name'] }}</h3>
                    <p class="text-sm text-slate-400">{{ $package['description'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>

            <!-- Package Details -->
            <div class="space-y-3 mb-6">
                <div class="flex justify-between items-center py-2 border-b border-slate-700">
                    <span class="text-slate-400 text-sm">Investment Range</span>
                    <span class="text-white font-semibold">${{ number_format($package['min_amount']) }} - ${{ number_format($package['max_amount']) }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-700">
                    <span class="text-slate-400 text-sm">Daily Profit</span>
                    <span class="text-green-400 font-semibold">{{ $package['daily_profit'] }}%</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-700">
                    <span class="text-slate-400 text-sm">Duration</span>
                    <span class="text-white font-semibold">{{ $package['duration'] }} Days</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-slate-400 text-sm">Total Return</span>
                    <span class="text-purple-400 font-semibold">{{ $package['daily_profit'] * $package['duration'] }}%</span>
                </div>
            </div>

            <!-- Invest Button -->
            <button onclick="openInvestModal('{{ $package['name'] }}', {{ $package['min_amount'] }}, {{ $package['max_amount'] }})"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition">
                Invest Now
            </button>
        </div>
        @endforeach
    </div>

    <!-- Investment Info -->
    <div class="bg-slate-800/50 rounded-xl p-4">
        <h3 class="text-white font-semibold mb-3">Investment Guidelines</h3>
        <ul class="space-y-2 text-sm text-slate-400">
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Profits are calculated daily and credited to your profit wallet.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Principal is returned at the end of the investment period.</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>You can have multiple active investments at the same time.</span>
            </li>
        </ul>
    </div>
</div>

<!-- Investment Modal (Hidden by default) -->
<div id="investModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-slate-800 rounded-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-white" id="modalPlanName">Plan A</h3>
            <button onclick="closeInvestModal()" class="text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="plan" id="modalPlanInput">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Investment Amount (USD)</label>
                <input type="number" 
                       name="amount" 
                       id="modalAmountInput"
                       min="100" 
                       step="0.01"
                       placeholder="Enter amount"
                       class="w-full bg-slate-700 text-white px-4 py-3 rounded-lg border border-slate-600 focus:outline-none focus:border-purple-500">
                <p class="text-xs text-slate-500 mt-1" id="modalAmountRange">Range: $100 - $999</p>
            </div>
            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition">
                Confirm Investment
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openInvestModal(planName, minAmount, maxAmount) {
        document.getElementById('modalPlanName').textContent = planName;
        document.getElementById('modalPlanInput').value = planName;
        document.getElementById('modalAmountInput').min = minAmount;
        document.getElementById('modalAmountInput').max = maxAmount;
        document.getElementById('modalAmountInput').placeholder = 'Enter amount ($' + minAmount + ' - $' + maxAmount + ')';
        document.getElementById('modalAmountRange').textContent = 'Range: $' + minAmount.toLocaleString() + ' - $' + maxAmount.toLocaleString();
        document.getElementById('investModal').classList.remove('hidden');
        document.getElementById('investModal').classList.add('flex');
    }

    function closeInvestModal() {
        document.getElementById('investModal').classList.add('hidden');
        document.getElementById('investModal').classList.remove('flex');
    }

    // Close modal when clicking outside
    document.getElementById('investModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeInvestModal();
        }
    });
</script>
@endpush
@endsection
