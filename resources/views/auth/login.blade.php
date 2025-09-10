@extends('layouts.guest')
@section('content')
    <div class="login-card">
        <div class="login-header">
            <h2>Welcome Back! 👋</h2>
            <p>Login to access your expenses dashboard</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"
                              type="email" name="email"
                              :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password" name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <!-- Forgot Password & Login Button -->
            <div class="flex flex-col gap-3 mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-center">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Register Link -->
        @if (Route::has('register'))
            <p class="text-center mt-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                    {{ __('Register') }}
                </a>
            </p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('.login-card');
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.7s ease';
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
@endsection
