@extends('layouts.guest')

@section('content')
    <div class="login-card">
        <div class="login-header">
            <h2>Forgot Password? 🔑</h2>
            <p>No problem! Enter your email below and we’ll send you a reset link</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col gap-3 mt-4">
                <x-primary-button>
                    {{ __('Send Reset Link') }}
                </x-primary-button>

                <a href="{{ route('login') }}" class="text-center">
                    {{ __('Back to Login') }}
                </a>
            </div>
        </form>
    </div>
@endsection
