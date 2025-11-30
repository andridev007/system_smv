@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-white mb-6">Login</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-600 text-white rounded">
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
                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Enter your username" required autofocus>
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Enter your password" required>
        </div>

        <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">
            Login
        </button>
    </form>

    <p class="mt-6 text-center text-gray-400">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 underline">Register</a>
    </p>
</div>
@endsection
