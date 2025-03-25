@extends('layouts.master')
@section('content')
    @include('navbar.after_login')
    <section class="min-h-screen flex flex-col items-center justify-start pt-12 bg-white dark:bg-gray-700">
        <div
            class="w-11/12 max-w-full p-6 m-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Articles</h2>

            @if ($articles->isEmpty())
                <p class="text-gray-400 text-2xl text-center">You have not written any articles yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($articles as $article)
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 border rounded-lg">
                            <!-- Wrap title and excerpt in an anchor tag for clickable article -->
                            <a href="{{ route('articles.show', $article->ArticleId) }}" class="block">
                                <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">{{ $article->Title }}</h3>
                                <p class="mb-2 text-gray-700 dark:text-gray-300">
                                    {{ Str::limit(strip_tags($article->Body), 100) }}</p>
                            </a>
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
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
