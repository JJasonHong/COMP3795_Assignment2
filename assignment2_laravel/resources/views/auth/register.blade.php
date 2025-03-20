@extends('layouts.master')

@section('content')
    @include('navbar.before_login')
    <section class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-700">
        <div class="grid grid-cols-10 gap-4 w-full max-w-6xl">
            <!-- Left side: Welcome message -->
            <div class="col-span-6 pl-20">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-8">
                    Become a member today and <br>Unlock your creative potential!
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:pr-16 xl:pr-48 dark:text-gray-400">
                    By becoming a member, you can create your own personal articles, and you’ll have the freedom to update or delete them whenever you like.
                </p>
            </div>
            
            <!-- Right side: Registration form -->
            <div class="col-span-4">
                <form class="max-w-md mx-auto" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- First Name and Last Name -->
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <!-- First Name -->
                        <div>
                            <x-input-label for="firstName" class="text-white" :value="__('First Name')" />
                            <x-text-input id="firstName" 
                                          class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" 
                                          type="text" 
                                          name="firstName" 
                                          :value="old('firstName')" 
                                          required autofocus autocomplete="given-name" />
                            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                        </div>
                        <!-- Last Name -->
                        <div>
                            <x-input-label for="lastName" class="text-white" :value="__('Last Name')" />
                            <x-text-input id="lastName" 
                                          class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" 
                                          type="text" 
                                          name="lastName" 
                                          :value="old('lastName')" 
                                          required autocomplete="family-name" />
                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                        </div>
                    </div>
                    
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" class="text-white" :value="__('Email')" />
                        <x-text-input id="email" 
                                      class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" class="text-white" :value="__('Password')" />
                        <x-text-input id="password" 
                                      class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" 
                                      type="password" 
                                      name="password" 
                                      required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" class="text-white" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" 
                                      class="block mt-1 w-full text-white bg-transparent border-0 border-b-2 border-white" 
                                      type="password" 
                                      name="password_confirmation" 
                                      required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection