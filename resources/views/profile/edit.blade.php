@extends('layouts.app-dashboard')

@section('title', 'Profile')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profile</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Kelola informasi akun, password, dan keamanan akun Anda</p>
    </div>

    <div class="space-y-6">
        <div class="p-4 bg-white shadow-md sm:p-8 dark:bg-gray-800 rounded-xl">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 bg-white shadow-md sm:p-8 dark:bg-gray-800 rounded-xl">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 bg-white shadow-md sm:p-8 dark:bg-gray-800 rounded-xl">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
