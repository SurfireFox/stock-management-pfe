@extends('admindashboard.layout')

@section('title', 'Users History')
@section('page_title', 'Users Activity History')

@section('extra_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">User Activity Logs</h2>
        <div class="flex space-x-2">
            <button id="exportPdf" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </button>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-chart-line mr-2"></i> Analytics
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <h3 class="text-lg font-medium text-gray-700 mb-3">Filters</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Users</option>
                    <option value="1">John Doe</option>
                    <option value="2">Jane Smith</option>
                    <option value="3">Robert Johnson</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Activity Type</label>
                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Activities</option>
                    <option value="login">Login</option>
                    <option value="order">Order Placed</option>
                    <option value="profile">Profile Update</option>
                    <option value="payment">Payment</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                <input type="text" id="date-range" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Select date range">
            </div>
            <div class="flex items-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-full">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="relative">
        <!-- Timeline line -->
        <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
        
        <!-- Timeline items -->
        <div class="space-y-8 relative">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center 
                        {{ $i % 4 == 0 ? 'bg-red-100 text-red-600' : '' }}
                        {{ $i % 4 == 1 ? 'bg-green-100 text-green-600' : '' }}
                        {{ $i % 4 == 2 ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $i % 4 == 3 ? 'bg-yellow-100 text-yellow-600' : '' }}
                        z-10">
                        <i class="
                            {{ $i % 4 == 0 ? 'fas fa-times-circle' : '' }}
                            {{ $i % 4 == 1 ? 'fas fa-shopping-cart' : '' }}
                            {{ $i % 4 == 2 ? 'fas fa-sign-in-alt' : '' }}
                            {{ $i % 4 == 3 ? 'fas fa-user-edit' : '' }}
                        "></i>
                    </div>
                    <div class="ml-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100 w-full">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">
                                    {{ $i % 4 == 0 ? 'Order Cancelled' : '' }}
                                    {{ $i % 4 == 1 ? 'Order Placed' : '' }}
                                    {{ $i % 4 == 2 ? 'User Login' : '' }}
                                    {{ $i % 4 == 3 ? 'Profile Updated' : '' }}
                                </h4>
                                <p class="text-gray-600 mt-1">
                                    {{ $i % 4 == 0 ? 'User cancelled order #ORD-' . (1000 + $i) : '' }}
                                    {{ $i % 4 == 1 ? 'User placed a new order #ORD-' . (1000 + $i) . ' with ' . ($i + 1) . ' items' : '' }}
                                    {{ $i % 4 == 2 ? 'User logged in from ' . ($i % 2 == 0 ? 'mobile device' : 'desktop browser') : '' }}
                                    {{ $i % 4 == 3 ? 'User updated their profile information' : '' }}
                                </p>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ date('M d, Y H:i', strtotime('-' . $i . ' hours')) }}
                            </div>
                        </div>
                        <div class="mt-3 flex items-center">
                            <img src="https://via.placeholder.com/30" alt="User" class="w-6 h-6 rounded-full">
                            <span class="ml-2 text-sm text-gray-700">User {{ $i }}</span>
                            <span class="ml-auto text-xs px-2 py-1 rounded-full 
                                {{ $i % 4 == 0 ? 'bg-red-100 text-red-800' : '' }}
                                {{ $i % 4 == 1 ? 'bg-green-100 text-green-800' : '' }}
                                {{ $i % 4 == 2 ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $i % 4 == 3 ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ $i % 4 == 0 ? 'Cancellation' : '' }}
                                {{ $i % 4 == 1 ? 'Purchase' : '' }}
                                {{ $i % 4 == 2 ? 'Authentication' : '' }}
                                {{ $i % 4 == 3 ? 'Account' : '' }}
                            </span>
                        </div>
                        <div class="mt-2 flex justify-end">
                            <a href="#" class="text-blue-600 hover:text-blue-900 text-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Load More -->
    <div class="mt-8 text-center">
        <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-6 rounded-lg">
            Load More Activities
        </button>
    </div>
</div>

<!-- Analytics Section -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Activity Analytics</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Activity by Type -->
        <div class="border border-gray-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Activity by Type</h3>
            <div class="h-64 flex items-center justify-center bg-gray-50">
                <p class="text-gray-500">Chart will be rendered here</p>
            </div>
        </div>
        
        <!-- Activity by Time -->
        <div class="border border-gray-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Activity by Time</h3>
            <div class="h-64 flex items-center justify-center bg-gray-50">
                <p class="text-gray-500">Chart will be rendered here</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date picker
        flatpickr("#date-range", {
            mode: "range",
            dateFormat: "Y-m-d",
        });
        
        // PDF Export functionality
        document.getElementById('exportPdf').addEventListener('click', function() {
            // PDF export logic would go here
            alert('PDF export functionality will be implemented here');
        });
    });
</script>
@endsection