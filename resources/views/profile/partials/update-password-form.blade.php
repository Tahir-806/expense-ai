{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}

<section>
    <header>
        <h2 class="profile-section-title">
            <i class="bi bi-shield-lock"></i> {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label for="update_password_current_password" class="profile-form-label">
                {{ __('Current Password') }}
            </label>
            <div class="relative">
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="profile-form-input pr-10"
                    autocomplete="current-password"
                />
                <i class="bi bi-eye absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer"></i>
            </div>
            @foreach($errors->updatePassword->get('current_password') ?? [] as $msg)
                <div class="profile-form-error">{{ $msg }}</div>
            @endforeach
        </div>

        <div class="space-y-2">
            <label for="update_password_password" class="profile-form-label">
                {{ __('New Password') }}
            </label>
            <div class="relative">
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="profile-form-input pr-10"
                    autocomplete="new-password"
                />
                <i class="bi bi-eye absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer"></i>
            </div>
            @foreach($errors->updatePassword->get('password') ?? [] as $msg)
                <div class="profile-form-error">{{ $msg }}</div>
            @endforeach
        </div>

        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="profile-form-label">
                {{ __('Confirm Password') }}
            </label>
            <div class="relative">
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="profile-form-input pr-10"
                    autocomplete="new-password"
                />
                <i class="bi bi-eye absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer"></i>
            </div>
            @foreach($errors->updatePassword->get('password_confirmation') ?? [] as $msg)
                <div class="profile-form-error">{{ $msg }}</div>
            @endforeach
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="profile-save-btn">
                <i class="bi bi-shield-check mr-2"></i>{{ __('Save') }}
            </button>
            @if (session('status') === 'password-updated')
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
