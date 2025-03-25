@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
    @include('navbar.after_login')
    <section class="min-h-screen flex items-start justify-center pt-12 bg-white dark:bg-gray-700">
        <div class="w-250 p-6 m-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Edit Post</h2>

            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('articles.update', $article->ArticleId) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Title</label>
                    <input type="text" id="title" name="Title" value="{{ $article->Title }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>
                </div>

                <div class="mb-4">
                    <label for="body" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Body</label>
                    <textarea id="body" name="Body" rows="5" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>{{ $article->Body }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="start_date" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Start Date</label>
                    <input type="date" id="start_date" name="StartDate" value="{{ $article->StartDate }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">End Date</label>
                    <input type="date" id="end_date" name="EndDate" value="{{ $article->EndDate }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" required>
                </div>
                
                <!-- Hidden input for ContributorUsername -->
                <input type="hidden" name="ContributorUsername" value="{{ $article->ContributorUsername }}">

                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update Post
                </button>
            </form>
        </div>
    </section>
@endsection