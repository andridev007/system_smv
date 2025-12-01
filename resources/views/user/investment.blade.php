@extends('layouts.app')

@section('title', 'Investment')

@section('content')
<div class="p-4 lg:p-6 space-y-6">
    <!-- Page Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-xl font-bold text-white">Investment Packages</h1>
    </div>

    <!-- Investment Info -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white">
        <h2 class="text-lg font-semibold mb-2">Choose Your Investment Plan</h2>
        <p class="text-purple-100 text-sm">Select a package that suits your investment goals. Higher investments offer better returns.</p>
    </div>

    <!-- Investment Packages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($packages as $package)
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-purple-500 transition">
            <!-- Package Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white">{{ $package['name'] }}</h3>
                <span class="px-3 py-1 bg-purple-500/20 text-purple-400 text-sm font-medium rounded-full">
                    {{ $package['daily_profit'] }}% Daily
                </span>
            </div>

            <!-- Package Details -->
            <div class="space-y-3 mb-6">
                <div class="flex justify-between">
                    <span class="text-slate-400 text-sm">Min Investment</span>
                    <span class="text-white font-medium">${{ number_format($package['min_amount']) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 text-sm">Max Investment</span>
                    <span class="text-white font-medium">${{ number_format($package['max_amount']) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 text-sm">Duration</span>
                    <span class="text-white font-medium">{{ $package['duration_days'] }} Days</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 text-sm">Total Return</span>
                    <span class="text-green-400 font-bold">{{ $package['total_return'] }}%</span>
                </div>
            </div>

            <!-- Progress Bar Visual -->
            <div class="mb-6">
                <div class="flex justify-between text-xs text-slate-400 mb-1">
                    <span>ROI Progress</span>
                    <span>{{ $package['total_return'] }}%</span>
                </div>
                <div class="h-2 bg-slate-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-blue-500 rounded-full" style="width: {{ min($package['total_return'], 100) }}%"></div>
                </div>
            </div>

            <!-- Invest Button -->
            <button type="button" 
                    onclick="openInvestModal('{{ $package['name'] }}', {{ $package['min_amount'] }}, {{ $package['max_amount'] }})"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-xl transition">
                Invest Now
            </button>
        </div>
        @endforeach
    </div>

    <!-- Investment Terms -->
    <div class="bg-slate-800 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Investment Terms</h3>
        <ul class="space-y-2 text-sm text-slate-400">
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Daily profits are calculated based on your investment amount</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Profits are credited to your profit wallet automatically</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Principal is returned at the end of the investment period</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Multiple investments can be active simultaneously</span>
            </li>
        </ul>
    </div>
</div>

<!-- Investment Modal -->
<div id="investModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-slate-800 rounded-xl p-6 w-full max-w-md">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-white" id="modalPlanName">Plan A</h3>
            <button onclick="closeInvestModal()" class="text-slate-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="plan" id="modalPlan">
            
            <div>
                <label for="investAmount" class="block text-sm font-medium text-slate-300 mb-2">
                    Investment Amount (USD)
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">$</span>
                    <input type="number" 
                           name="amount" 
                           id="investAmount" 
                           step="1"
                           placeholder="0"
                           class="w-full bg-slate-700 text-white pl-8 pr-4 py-3 rounded-lg border border-slate-600 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 focus:outline-none transition"
                           required>
                </div>
                <p class="mt-2 text-xs text-slate-400" id="modalAmountRange">Min: $100 - Max: $999</p>
            </div>

            <button type="submit" 
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-xl transition">
                Confirm Investment
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openInvestModal(planName, minAmount, maxAmount) {
        document.getElementById('modalPlanName').textContent = planName;
        document.getElementById('modalPlan').value = planName;
        document.getElementById('investAmount').min = minAmount;
        document.getElementById('investAmount').max = maxAmount;
        document.getElementById('investAmount').placeholder = minAmount;
        document.getElementById('modalAmountRange').textContent = `Min: $${minAmount.toLocaleString()} - Max: $${maxAmount.toLocaleString()}`;
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
