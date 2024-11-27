<x-app-layout>
    <x-slot:title>
        Profile
    </x-slot>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <div class="py-12">

        <h2 class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 text-4xl mb-4 font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>

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
</x-app-layout>
