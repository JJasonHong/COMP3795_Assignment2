@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Post</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ url('/articles/' . $article->ArticleId) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" id="title" name="Title" class="form-control" value="{{ $article->Title }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label fw-bold">Body</label>
            <textarea id="body" name="Body" class="form-control" rows="5" required>{{ $article->Body }}</textarea>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Your Username</label>
            <input type="text" id="username" name="ContributorUsername" class="form-control" value="{{ $article->ContributorUsername }}" required>
        </div>

        <div class="mb-3">
            <label for="creat_date" class="form-label fw-bold">Creation Date</label>
            <input type="date" id="creat_date" name="CreatDate" class="form-control" value="{{ $article->CreatDate }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label fw-bold">Start Date</label>
            <input type="date" id="start_date" name="StartDate" class="form-control" value="{{ $article->StartDate }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label fw-bold">End Date</label>
            <input type="date" id="end_date" name="EndDate" class="form-control" value="{{ $article->EndDate }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection