{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}



    {{-- // edit.blade.php ke top me --}}
    @php
        $user = Auth::user();
    @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#2563eb] leading-tight flex items-center gap-2">
            <i class="bi bi-person-circle"></i>
            {{ __('Profile') }} - {{ $user->name }}
        </h2>
    </x-slot>

    <style>
        body {
            background: linear-gradient(135deg, #f4f7fd 0%, #e9eefb 100%);
            min-height: 100vh;
        }

        .profile-card {
            background: #fff;
            border-radius: 1.7rem;
            box-shadow: 0 8px 32px 0 rgba(56, 163, 220, 0.11), 0 1.5px 5px 0 rgba(56, 163, 220, 0.08);
            padding: 2.2rem 2.3rem;
            margin-bottom: 2.2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            border: 2px solid #e5eaf6;
        }

        .profile-section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .profile-form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .profile-form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .profile-form-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .profile-form-error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .profile-save-btn {
            background: linear-gradient(90deg, #38b6ff 0%, #2563eb 100%);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: center;
        }

        .profile-save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        }

        .profile-delete-btn {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .profile-delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #e5eaf6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #2563eb;
        }

        .profile-meta {
            flex: 1;
        }

        .profile-meta h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2563eb;
            margin-bottom: 0.25rem;
        }

        .profile-meta p {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .profile-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .status-verified {
            background: #dcfce7;
            color: #166534;
        }

        .status-unverified {
            background: #fef3c7;
            color: #92400e;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <div class="py-10">
        <div class="max-w-4xl mx-auto space-y-6 px-4">

            <!-- Test section to see if content shows -->
            <div style="background: white; padding: 20px; border-radius: 10px; margin: 20px; border: 1px solid #ccc;">
                <h3 style="color: #2563eb;">Profile Information Test</h3>
                <p>User: {{ $user->name ?? 'No user found' }}</p>
                <p>Email: {{ $user->email ?? 'No email found' }}</p>
                <p>This is a test to see if content shows up.</p>
            </div>

            <div class="profile-card">
                <!-- Add user info summary -->
                <div class="profile-info">
                    <div class="profile-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="profile-meta">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                        <div class="profile-status {{ $user->email_verified_at ? 'status-verified' : 'status-unverified' }}">
                            <i class="bi {{ $user->email_verified_at ? 'bi-check-circle' : 'bi-clock' }}"></i>
                            {{ $user->email_verified_at ? __('Verified Account') : __('Pending Verification') }}
                        </div>
                    </div>
                </div>

                <!-- Test simple form instead of include -->
                <div style="border: 1px solid #ddd; padding: 15px; margin-top: 15px; border-radius: 8px;">
                    <h4 style="color: #2563eb;">Update Profile Information</h4>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div style="margin-bottom: 15px;">
                            <label for="name" style="display: block; font-weight: 600; margin-bottom: 5px;">Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label for="email" style="display: block; font-weight: 600; margin-bottom: 5px;">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                        </div>

                        <button type="submit" style="background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Test if includes work -->
            <div class="profile-card">
                <h4 style="color: #2563eb;">Password Update Section</h4>
                @include('profile.partials.update-password-form')
            </div>

            <div class="profile-card">
                <h4 style="color: #2563eb;">Delete Account Section</h4>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <!-- Add Alpine.js for modal functionality -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-app-layout>

