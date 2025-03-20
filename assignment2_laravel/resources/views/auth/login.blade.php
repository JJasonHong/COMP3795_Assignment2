@extends('layouts.master')

@section('content')
    @include('navbar.before_login')

    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-700">
        <div class="w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Sign In header -->
            <h1 class="text-2xl text-white font-bold mb-4">Sign In</h1>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" class="text-white" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" type="email"
                        name="username" :value="old('username')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" class="text-white" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" type="password"
                        name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-white hover:text-white" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-4">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
@endsection
