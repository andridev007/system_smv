@extends('layouts.guest')

@section('content')
<div class="bg-gray-800 rounded-lg shadow-xl p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>

    @if ($errors->any())
        <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
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
            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter your full name" required autofocus>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter your email" required>
        </div>

        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Choose a username" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter your phone number" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input type="password" name="password" id="password"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Create a password" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Confirm your password" required>
        </div>

        <div class="mb-4">
            <label for="referral_code" class="block text-sm font-medium text-gray-300 mb-2">Referral Code (Optional)</label>
            <input type="text" name="referral_code" id="referral_code" value="{{ old('referral_code') }}"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter referral code">
        </div>

        <div class="mb-6">
            <div class="flex items-start">
                <input type="checkbox" name="terms" id="terms"
                    class="h-4 w-4 mt-1 text-blue-500 bg-gray-700 border-gray-600 rounded focus:ring-blue-500" required>
                <label for="terms" class="ml-2 text-sm text-gray-300">
                    I agree to the <a href="#" class="text-blue-400 hover:text-blue-300">Terms of Service</a> and <a href="#" class="text-blue-400 hover:text-blue-300">Privacy Policy</a>
                </label>
            </div>
        </div>

        <button type="submit"
            class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-400">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">Login</a>
    </p>
</div>
@endsection
