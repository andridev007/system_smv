@extends('layouts.guest')

@section('content')
<div class="bg-gray-800 rounded-lg shadow-xl p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

    @if ($errors->any())
        <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter your username" required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input type="password" name="password" id="password"
                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Enter your password" required>
        </div>

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="h-4 w-4 text-blue-500 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                <label for="remember" class="ml-2 text-sm text-gray-300">Remember me</label>
            </div>
            <a href="#" class="text-sm text-blue-400 hover:text-blue-300">Forgot Password?</a>
        </div>

        <button type="submit"
            class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
            Login
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-400">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">Register</a>
    </p>
</div>
@endsection
