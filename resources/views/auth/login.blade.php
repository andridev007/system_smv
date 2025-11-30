@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-slate-800 rounded-lg shadow-xl p-8">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 rounded-lg p-4 mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-slate-300 mb-2">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-slate-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-slate-400">
            Don't have an account?
            <a href="/register" class="text-blue-400 hover:text-blue-300 font-medium">Register</a>
        </p>
    </div>
</div>
@endsection
