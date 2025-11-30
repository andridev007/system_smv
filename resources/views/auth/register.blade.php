@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-slate-800 rounded-lg shadow-xl p-8">
        <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 rounded-lg p-4 mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-slate-300 mb-2">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-6">
                <label for="referral_code" class="block text-sm font-medium text-slate-300 mb-2">Referral Code</label>
                <input type="text" name="referral_code" id="referral_code" value="{{ old('referral_code') }}"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-slate-400">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Login</a>
        </p>
    </div>
</div>
@endsection
