@extends('admindashboard.layout')

@section('title', 'Users Management')
@section('page_title', 'Users Management')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-blue-900">Users Management</h2>
        <div class="flex space-x-3">
            <button id="exportPdf" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg flex items-center shadow-sm transition duration-300">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </button>
            <a href="{{ route('createusers') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg flex items-center shadow-sm transition duration-300">
                <i class="fas fa-user-plus mr-2"></i> Add User
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
        <h3 class="text-lg font-semibold text-blue-800 mb-4">Filters</h3>
        <form action="{{ route('indexusers') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1.5">Role</label>
                <select id="role" name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">All Roles</option>
                    <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>Administrator</option>
                    <option value="2" {{ request('role') == '2' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1.5">Registration Date</label>
                <input type="date" id="date" name="date" value="{{ request('date') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg w-full shadow-sm transition duration-300 font-medium">
                    <i class="fas fa-filter mr-2"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Registered</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users ?? [] as $user)
                <tr class="hover:bg-blue-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full overflow-hidden">
                                @if($user->photo)
                                    <img class="h-10 w-10 object-cover" src="{{ asset($user->photo) }}" alt="{{ $user->firstname }}">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $user->role_id == 1 ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $user->role_id == 1 ? 'Administrator' : 'Customer' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('editusers', $user->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-150" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('destroyusers', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="#" class="text-gray-600 hover:text-gray-900 transition duration-150" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
                            <p class="text-lg">No users found</p>
                            <a href="{{ route('createusers') }}" class="mt-2 text-blue-600 hover:text-blue-800">Add your first user</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        @if(isset($users) && $users->hasPages())
            {{ $users->links() }}
        @else
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ isset($users) ? $users->count() : 0 }}</span> results
                </p>
            </div>
        @endif
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div id="successAlert" class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md max-w-md animate-fade-in-right">
    <div class="flex items-center">
        <div class="py-1"><i class="fas fa-check-circle text-green-500 mr-3"></i></div>
        <div>
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
        <button onclick="document.getElementById('successAlert').remove()" class="ml-auto text-green-700 hover:text-green-900">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // PDF Export functionality
        document.getElementById('exportPdf').addEventListener('click', function() {
            // PDF export logic would go here
            alert('PDF export functionality will be implemented here');
        });

        // Auto-hide success message after 5 seconds
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('opacity-0');
                setTimeout(() => successAlert.remove(), 500);
            }, 5000);
        }
    });
</script>
@endsection
