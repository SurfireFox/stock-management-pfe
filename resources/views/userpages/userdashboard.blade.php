<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Stock-Management-MedHK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 h-screen bg-blue-900 text-white fixed left-0 top-0 overflow-y-auto">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Stock-Management</h2>
                <div class="border-t border-blue-800 my-4"></div>
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center">
                        <span class="text-lg font-bold">{{ substr(auth()->user()->firstname ?? auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium">{{ auth()->user()->firstname ?? auth()->user()->name }}</p>
                        <p class="text-sm text-blue-300">Customer</p>
                    </div>
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="/userdashboard" class="flex items-center space-x-3 p-3 rounded-lg bg-blue-800">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/userprofile" class="flex items-center px-4 py-3 bg-blue-50 text-blue-600 rounded-lg">
                                <i class="fas fa-user mr-3 text-blue-500"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/shop" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition-colors">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Shop</span>
                            </a>
                        </li>
                        <li>
                            <a href="/panier" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition-colors">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Cart</span>
                            </a>
                        </li>
                        <li>
                            <a href="/" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition-colors">
                                <i class="fas fa-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="border-t border-blue-800 my-6"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition-colors w-full">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 w-full">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center px-8 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200">
                            <i class="fas fa-bell text-gray-600"></i>
                        </button>
                        <div class="relative">
                            <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-8 mb-8 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                            <p class="opacity-90">Here's what's happening with your orders today.</p>
                        </div>
                        <div class="hidden md:block">
                            <img src="https://cdn-icons-png.flaticon.com/512/1356/1356479.png" alt="Dashboard" class="w-24 h-24 opacity-80">
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Orders</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $totalOrders ?? 0 }}</h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-gray-600">
                            <span class="text-green-500"><i class="fas fa-arrow-up"></i> 12%</span> from last month
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Completed Orders</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $completedOrders ?? 0 }}</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-gray-600">
                            <span class="text-green-500"><i class="fas fa-arrow-up"></i> 8%</span> from last month
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Pending Orders</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $pendingOrders ?? 0 }}</h3>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-gray-600">
                            <span class="text-red-500"><i class="fas fa-arrow-down"></i> 3%</span> from last month
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Recent Orders</h3>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($commandes ?? [] as $commande)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $commande->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $commande->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $commande->items_count ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${{ $commande->total ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $commande->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $commande->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $commande->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($commande->status ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="/commandes/{{ $commande->id }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-gray-600 hover:text-gray-900">Track</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-shopping-cart text-gray-300 text-5xl mb-4"></i>
                                                <p>No orders found</p>
                                                <a href="/shop" class="mt-2 text-blue-600 hover:text-blue-800">Browse products</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
