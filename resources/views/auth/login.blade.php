<x-guest-layout>
    <h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus placeholder="Enter your username">
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required placeholder="Enter your password">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex-between mt-4">
            <a class="link" href="#">
                Forgot Password?
            </a>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn">
                Login
            </button>
        </div>

        <div class="text-center mt-4">
            <span style="color: #A1A09A; font-size: 0.875rem;">Don't have an account?</span>
            <a class="link" href="{{ route('register') }}">Register</a>
        </div>
    </form>
</x-guest-layout>
