@extends('layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    @include('navbar.after_login')
    <section class="min-h-screen bg-white dark:bg-gray-700 pt-12">
        <div class="w-11/12 max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h2>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 border border-blue-700 rounded hover:bg-blue-700 hover:text-white dark:text-blue-300 dark:border-blue-300">
                    Back to Home
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- User Management Section -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm mb-8">
                <div class="bg-blue-700 dark:bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">User Management</h5>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Username
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">
                                    Registration Date</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Status
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Role</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-900 dark:text-white">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $user->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $user->username }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $user->firstName }}
                                        {{ $user->lastName }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $user->registrationDate->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-2">
                                        @if ($user->isApproved)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($user->role === 'Admin')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Contributor</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <!-- Approval Toggle Button -->
                                            <form action="{{ url('/admin/users/' . $user->id . '/approve') }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs font-medium border rounded {{ $user->isApproved ? 'border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white' : 'border-green-500 text-green-500 hover:bg-green-500 hover:text-white' }}">
                                                    {{ $user->isApproved ? 'Revoke' : 'Approve' }}
                                                </button>
                                            </form>
                                            <!-- Role Update Form -->
                                            <form action="{{ url('/admin/users/' . $user->id . '/role') }}" method="POST"
                                                class="flex items-center space-x-1">
                                                @csrf
                                                <select name="role"
                                                    class="block text-xs border border-gray-300 rounded p-1 dark:bg-gray-700 dark:text-white">
                                                    <option value="Contributor"
                                                        {{ $user->role === 'Contributor' ? 'selected' : '' }}>Contributor
                                                    </option>
                                                    <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                </select>
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs font-medium border rounded border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">
                                                    Update
                                                </button>
                                            </form>
                                            <!-- Delete User Form -->
                                            <form action="{{ url('/admin/users/' . $user->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs font-medium border rounded border-red-500 text-red-500 hover:bg-red-500 hover:text-white">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- User Statistics Section -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                <div class="bg-blue-700 dark:bg-blue-600 text-white p-4 rounded-t-lg">
                    <h5 class="text-lg font-semibold">User Statistics</h5>
                </div>
                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Total Users</h5>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $users->count() }}</p>
                    </div>
                    <div class="text-center">
                        <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Approved Users</h5>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $users->where('isApproved', true)->count() }}</p>
                    </div>
                    <div class="text-center">
                        <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Pending Users</h5>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $users->where('isApproved', false)->count() }}</p>
                    </div>
                    <div class="text-center">
                        <h5 class="text-sm font-semibold text-gray-900 dark:text-white">Admins</h5>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $users->where('role', 'Admin')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Add any JavaScript functionality here if needed
    </script>
@endsection
