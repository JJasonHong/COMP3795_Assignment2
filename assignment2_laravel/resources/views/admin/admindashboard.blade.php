@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
        <a href="{{ url('/') }}" class="btn btn-outline-primary">Back to Home</a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Management</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->firstName }} {{ $user->lastName }}</td>
                            <td>{{ $user->registrationDate->format('Y-m-d H:i') }}</td>
                            <td>
                                <span class="badge {{ $user->isApproved ? 'bg-success' : 'bg-warning' }}">
                                    {{ $user->isApproved ? 'Approved' : 'Pending' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $user->role === 'Admin' ? 'bg-danger' : 'bg-info' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Approval Toggle Button -->
                                    <form action="{{ url('/admin/users/' . $user->id . '/approve') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $user->isApproved ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                            {{ $user->isApproved ? 'Revoke' : 'Approve' }}
                                        </button>
                                    </form>
                                    
                                    <!-- Role Update Form -->
                                    <form action="{{ url('/admin/users/' . $user->id . '/role') }}" method="POST" class="d-flex gap-1">
                                        @csrf
                                        <select name="role" class="form-select form-select-sm">
                                            <option value="Contributor" {{ $user->role === 'Contributor' ? 'selected' : '' }}>Contributor</option>
                                            <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                    </form>
                                    
                                    <!-- Delete User Form -->
                                    <form action="{{ url('/admin/users/' . $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Statistics</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-center h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="display-6">{{ $users->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Approved Users</h5>
                            <p class="display-6">{{ $users->where('isApproved', true)->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pending Users</h5>
                            <p class="display-6">{{ $users->where('isApproved', false)->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Admins</h5>
                            <p class="display-6">{{ $users->where('role', 'Admin')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any JavaScript functionality here if needed
</script>
@endsection