@extends('layouts.guest')

@section('content')
<div class="bg-gray-800 shadow-md rounded-lg px-8 py-6">
    <h2 class="text-2xl font-semibold text-center text-gray-100 mb-6">Login</h2>

    @if ($errors->any())
        <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded mb-4">
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
            <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-150">
                Login
            </button>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('register') }}" class="text-sm text-blue-400 hover:text-blue-300">
                Don't have an account? Register
            </a>
        </div>
    </form>
</div>
@endsection
