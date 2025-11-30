<x-guest-layout>
    <h1>Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email address">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required placeholder="Choose a username">
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Enter your phone number">
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required placeholder="Create a password">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm your password">
        </div>

        <div class="form-group">
            <label for="referral_code">Referral Code (Optional)</label>
            <input id="referral_code" type="text" name="referral_code" value="{{ old('referral_code') }}" placeholder="Enter referral code if you have one">
            @error('referral_code')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="checkbox-group">
            <input id="terms" type="checkbox" name="terms" required>
            <label for="terms">I agree to the <a class="link" href="#">Terms & Conditions</a></label>
        </div>
        @error('terms')
            <div class="error-message" style="margin-top: -0.5rem; margin-bottom: 1rem;">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <button type="submit" class="btn">
                Register
            </button>
        </div>

        <div class="text-center mt-4">
            <span style="color: #A1A09A; font-size: 0.875rem;">Already have an account?</span>
            <a class="link" href="{{ route('login') }}">Login</a>
        </div>
    </form>
</x-guest-layout>
