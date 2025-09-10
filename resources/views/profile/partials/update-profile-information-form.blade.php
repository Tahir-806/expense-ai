<section>
    <header>
        <h2 class="profile-section-title">
            <i class="bi bi-person-lines-fill"></i> {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <label for="name" class="profile-form-label">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                class="profile-form-input"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            />
            @foreach($errors->get('name') as $msg)
                <div class="profile-form-error">{{ $msg }}</div>
            @endforeach
        </div>

        <div class="space-y-2">
            <label for="email" class="profile-form-label">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                class="profile-form-input"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            />
            @foreach($errors->get('email') as $msg)
                <div class="profile-form-error">{{ $msg }}</div>
            @endforeach

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm">
                    <p class="text-amber-600 flex items-center gap-1">
                        <i class="bi bi-exclamation-triangle"></i>
                        {{ __('Your email address is unverified.') }}
                    </p>
                    <button
                        form="send-verification"
                        class="mt-2 text-blue-600 hover:text-blue-800 underline text-sm flex items-center gap-1"
                    >
                        <i class="bi bi-envelope"></i>
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600 flex items-center gap-1">
                            <i class="bi bi-check-circle"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="profile-save-btn">
                <i class="bi bi-save mr-2"></i>{{ __('Save') }}
            </button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 flex items-center gap-1"
                >
                    <i class="bi bi-check-circle"></i>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
