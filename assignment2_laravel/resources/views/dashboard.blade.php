@extends('layouts.master')
@section('content')
    @include('navbar.after_login')
    <section class="min-h-screen flex flex-col items-center justify-start pt-12 bg-white dark:bg-gray-700">
        <div class="w-11/12 max-w-full p-6 m-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Articles</h2>

            @if ($articles->isEmpty())
                <p class="text-gray-400 text-2xl text-center">You have not written any articles yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($articles as $article)
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 border rounded-lg transform hover:scale-102 transition duration-300 ease-in-out hover:shadow-lg">
                            <!-- Wrap title and excerpt in an anchor tag for clickable article -->
                            <a href="{{ route('articles.show', $article->ArticleId) }}" class="block">
                                <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">{{ $article->Title }}</h3>
                                <p class="mb-2 text-gray-700 dark:text-gray-300">
                                    {{ Str::limit(strip_tags($article->Body), 100) }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection