@extends('layouts.master')

@section('title', 'Edit Your Articles')

@section('content')
    @include('navbar.after_login')
    <section class="min-h-screen flex flex-col items-center justify-start pt-12 bg-white dark:bg-gray-700">
        <div class="w-11/12 max-w-4xl p-6 m-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Articles</h2>
            
            @if($articles->isEmpty())
                <p class="text-gray-700 dark:text-gray-400">You have not written any articles yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($articles as $article)
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 border rounded-lg">
                            <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">{{ $article->Title }}</h3>
                            <p class="mb-2 text-gray-700 dark:text-gray-300">{{ Str::limit($article->Body, 100) }}</p>
                            <a href="{{ route('articles.update', $article->ArticleId) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Edit
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection