{{-- <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section> --}}


<section>
    <header>
        <h2 class="profile-section-title">
            <i class="bi bi-trash3"></i> {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        class="profile-delete-btn mt-4 flex items-center gap-2"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <i class="bi bi-trash3"></i>
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="mb-6">
                <div class="flex items-center gap-2 text-red-600 mb-2">
                    <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                    <h2 class="text-lg font-semibold">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>
                </div>
                <p class="text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <div class="space-y-2">
                <label for="password" class="profile-form-label">
                    {{ __('Password') }}
                </label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="profile-form-input pr-10"
                        placeholder="{{ __('Enter your password to confirm') }}"
                    />
                    <i class="bi bi-eye absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer"></i>
                </div>
                @foreach($errors->userDeletion->get('password') ?? [] as $msg)
                    <div class="profile-form-error">{{ $msg }}</div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button
                    type="button"
                    class="profile-save-btn"
                    style="background: #e9eefb; color: #2563eb;"
                    x-on:click="$dispatch('close')"
                >
                    <i class="bi bi-x-circle mr-2"></i>
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="profile-delete-btn flex items-center gap-2">
                    <i class="bi bi-trash3"></i>
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
