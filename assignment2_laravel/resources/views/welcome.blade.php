@extends('layouts.master')
@section('content')
    @include('navbar.before_login')
    <section class="min-h-screen flex items-center bg-white dark:bg-gray-700">

        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Welcome to Your Creative Dashboard!</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Please sign in
                or create an account to get started.</p>
            <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <a href="{{ route('login') }}"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-600 border border-transparent hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Register
                </a>
            </div>

            <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                <span class="font-semibold text-gray-400 uppercase">MADE BY</span>
                <div class="flex flex-wrap justify-center items-center mt-8 text-gray-500 sm:justify-between">
                    <a href="#"
                        class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400 text-xl font-bold">
                        Jason Hong
                    </a>
                    <a href="#"
                        class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400 text-xl font-bold">
                        Gem Baojimin
                    </a>
                    <a href="#"
                        class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400 text-xl font-bold">
                        Brian Diep
                    </a>
                </div>
            </div>

        </div>
        
    </section>
@endsection
