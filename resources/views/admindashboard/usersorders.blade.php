@extends('admindashboard.layout')

@section('title', 'Orders Management')
@section('page_title', 'Orders Management')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-blue-900">Orders Management</h2>
        <div class="flex space-x-3">
            <button id="exportPdf" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg flex items-center shadow-sm transition duration-300">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </button>
            <button id="generateReport" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg flex items-center shadow-sm transition duration-300">
                <i class="fas fa-chart-line mr-2"></i> Generate Report
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
        <h3 class="text-lg font-semibold text-blue-800 mb-4">Filters</h3>
        <form action="{{ route('commande') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-5">
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1.5">Customer</label>
                <select id="user_id" name="user_id" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">All Customers</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->firstname }} {{ $user->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Date Range</label>
                <div class="flex space-x-2">
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Price Range</label>
                <div class="flex space-x-2">
                    <input type="number" name="price_min" placeholder="Min" value="{{ request('price_min') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    <input type="number" name="price_max" placeholder="Max" value="{{ request('price_max') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                </div>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg w-full shadow-sm transition duration-300 font-medium">
                    <i class="fas fa-filter mr-2"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Orders Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 p-5 rounded-xl shadow-sm border-l-4 border-blue-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-blue-800 mb-1">Total Orders</p>
                    <p class="text-3xl font-bold text-blue-900">{{ $stats['total'] }}</p>
                    <p class="text-xs text-blue-600 mt-1">
                        <span class="{{ $stats['total_change'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas fa-{{ $stats['total_change'] >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                            {{ abs($stats['total_change']) }}%
                        </span>
                        from last month
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-shopping-cart text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-green-50 p-5 rounded-xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-green-800 mb-1">Completed</p>
                    <p class="text-3xl font-bold text-green-900">{{ $stats['completed'] }}</p>
                    <p class="text-xs text-green-600 mt-1">
                        <span class="{{ $stats['completed_change'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas fa-{{ $stats['completed_change'] >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                            {{ abs($stats['completed_change']) }}%
                        </span>
                        from last month
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-yellow-50 p-5 rounded-xl shadow-sm border-l-4 border-yellow-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-yellow-800 mb-1">Pending</p>
                    <p class="text-3xl font-bold text-yellow-900">{{ $stats['pending'] }}</p>
                    <p class="text-xs text-yellow-600 mt-1">
                        <span class="{{ $stats['pending_change'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas fa-{{ $stats['pending_change'] >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                            {{ abs($stats['pending_change']) }}%
                        </span>
                        from last month
                    </p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-red-50 p-5 rounded-xl shadow-sm border-l-4 border-red-500 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-red-800 mb-1">Cancelled</p>
                    <p class="text-3xl font-bold text-red-900">{{ $stats['cancelled'] }}</p>
                    <p class="text-xs text-red-600 mt-1">
                        <span class="{{ $stats['cancelled_change'] >= 0 ? 'text-red-600' : 'text-green-600' }}">
                            <i class="fas fa-{{ $stats['cancelled_change'] >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                            {{ abs($stats['cancelled_change']) }}%
                        </span>
                        from last month
                    </p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Items</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($commandes as $commande)
                <tr class="hover:bg-blue-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-{{ $commande->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8 bg-gray-200 rounded-full overflow-hidden">
                                @if($commande->user && $commande->user->photo)
                                    <img class="h-8 w-8 object-cover" src="{{ asset($commande->user->photo) }}" alt="Customer avatar">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $commande->user ? $commande->user->firstname . ' ' . $commande->user->lastname : 'Unknown User' }}
                                </div>
                                <div class="text-sm text-gray-500">{{ $commande->user->email ?? 'No email' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $commande->created_at->format('M d, Y') }}
                        <div class="text-xs text-gray-400">{{ $commande->created_at->format('h:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $commande->products_count ?? $commande->products->count() ?? 0 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-700">
                        ${{ number_format($commande->total, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $commande->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $commande->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $commande->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $commande->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}">
                            {{ ucfirst($commande->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('commande', $commande->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-150" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('commande.update', $commande->id) }}" class="text-green-600 hover:text-green-900 transition duration-150" title="Edit Order">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('commande.delete', $commande->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150" title="Delete Order">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-shopping-cart text-gray-300 text-5xl mb-4"></i>
                            <p class="text-lg">No orders found</p>
                            <p class="text-sm text-gray-400 mt-1">Try adjusting your filters or check back later</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $commandes->withQueryString()->links() }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // PDF Export functionality
        document.getElementById('exportPdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Add title
            doc.setFontSize(18);
            doc.text('Orders Report', 14, 22);
            doc.setFontSize(11);
            doc.text('Generated on: ' + new Date().toLocaleDateString(), 14, 30);

            // Create the table
            doc.autoTable({
                startY: 40,
                head: [['Order ID', 'Customer', 'Date', 'Items', 'Total', 'Status']],
                body: Array.from(document.querySelectorAll('table tbody tr')).map(row => {
                    const cells = row.querySelectorAll('td');
                    if (cells.length < 6) return null;
                    return [
                        cells[0].textContent.trim(),
                        cells[1].querySelector('.text-gray-900')?.textContent.trim() || 'Unknown',
                        cells[2].textContent.trim(),
                        cells[3].textContent.trim(),
                        cells[4].textContent.trim(),
                        cells[5].querySelector('span')?.textContent.trim() || 'Unknown'
                    ];
                }).filter(row => row !== null)
            });

            // Save the PDF
            doc.save('orders-report.pdf');
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
