@extends('layouts.master')

@section('title', 'Article Details')

@section('content')
    @include('navbar.after_login')
    <section class="min-h-screen flex flex-col items-center justify-start pt-12 bg-white dark:bg-gray-700">
        
        <div
            class="w-11/12 max-w-4xl p-6 m-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-4 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->Title }}</h2>
            <p class="mb-4 text-gray-700 dark:text-gray-300 break-words">{!! nl2br(e($article->Body)) !!}</p>
            <div class="mb-4 text-gray-600 dark:text-gray-400">
                <span>Start Date: {{ $article->StartDate }}</span> |
                <span>End Date: {{ $article->EndDate }}</span>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('articles.edit', $article->ArticleId) }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                </a>
                <form action="{{ route('articles.destroy', $article->ArticleId) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this article?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 rounded hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <a href="{{ route('dashboard') }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Back to Dashboard
    </a>
    </section>
   
@endsection
