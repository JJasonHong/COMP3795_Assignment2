@extends('layouts.master')

@section('title', 'Create a New Post')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Create a New Post</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Form submits to store() method --}}
    <form action="{{ url('/articles') }}" method="POST">
        @csrf {{-- CSRF protection (required for form submissions) --}}

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" id="title" name="Title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label fw-bold">Body</label>
            <textarea id="body" name="Body" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Your Username</label>
            <input type="text" id="username" name="ContributorUsername" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@endsection