<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SAMUVE') }} - @yield('title', 'Dashboard')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- TailwindCSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
        </style>
    </head>
    <body class="bg-[#0f172a] text-white antialiased min-h-screen">
        <div class="flex min-h-screen">
            <!-- Desktop Sidebar -->
            <aside class="hidden lg:flex lg:flex-col lg:w-64 bg-slate-800/50 border-r border-slate-700">
                <!-- Logo -->
                <div class="p-6 border-b border-slate-700">
                    <h1 class="text-2xl font-bold text-white">SAMUVE</h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('deposit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('deposit') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Deposit</span>
                    </a>

                    <a href="{{ route('investment') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('investment') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span>Invest</span>
                    </a>

                    <a href="{{ route('withdraw') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('withdraw') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Withdraw</span>
                    </a>

                    <a href="{{ route('transactions') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('transactions') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Transactions</span>
                    </a>

                    <a href="{{ route('referral') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('referral') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Referral</span>
                    </a>

                    <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('settings') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700/50' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="p-4 border-t border-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-sm font-semibold">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate">{{ auth()->user()->name ?? 'User' }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 pb-20 lg:pb-0">
                @yield('content')
            </main>
        </div>

        <!-- Mobile Bottom Navigation -->
        <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-slate-800 border-t border-slate-700 z-50">
            <div class="flex items-center justify-around h-16">
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('dashboard') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }} transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs mt-1">Dashboard</span>
                </a>

                <a href="{{ route('deposit') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('deposit') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }} transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-xs mt-1">Deposit</span>
                </a>

                <a href="{{ route('investment') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('investment') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }} transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="text-xs mt-1">Invest</span>
                </a>

                <a href="{{ route('referral') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('referral') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }} transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="text-xs mt-1">Referral</span>
                </a>

                <a href="{{ route('settings') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('settings') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }} transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-xs mt-1">Settings</span>
                </a>
            </div>
        </nav>

        @stack('scripts')
    </body>
</html>
