<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-col w-64 bg-white shadow-md">
            <div class="p-6 bg-blue-600">
                <h2 class="text-2xl font-bold text-white">Stock Management</h2>
            </div>
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="/userdashboard" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>
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
                        <a href="/shop" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                            <i class="fas fa-shopping-bag mr-3 text-gray-400"></i>
                            <span>Shop</span>
                        </a>
                    </li>
                    <li>
                        <a href="/panier" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-3 text-gray-400"></i>
                            <span>Cart</span>
                        </a>
                    </li>
                    <li class="mt-auto">
                        <form method="POST" action="{{ route('logout') }}" class="px-4">
                            @csrf
                            <button type="submit" class="flex w-full items-center py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors">
                                <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center px-6 py-4">
                    <div class="flex items-center">
                        <button class="md:hidden p-2 mr-4 rounded-md hover:bg-gray-100">
                            <i class="fas fa-bars text-gray-600"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
                    </div>
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
                <!-- Profile Information -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-8 py-10 text-white">
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="mb-6 md:mb-0 md:mr-8">
                                <img src="https://via.placeholder.com/150" alt="Profile" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold mb-2">{{ auth()->user()->name }}</h2>
                                <p class="text-blue-100 mb-4">{{ auth()->user()->email }}</p>
                                <div class="flex space-x-3">
                                    <button class="px-4 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-medium flex items-center">
                                        <i class="fas fa-edit mr-2"></i> Edit Profile
                                    </button>
                                    <button class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors font-medium flex items-center">
                                        <i class="fas fa-key mr-2"></i> Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Personal Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                    <p class="text-gray-800 font-medium">{{ auth()->user()->name }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                                    <p class="text-gray-800 font-medium">{{ auth()->user()->email }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                                    <p class="text-gray-800 font-medium">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Address</label>
                                    <p class="text-gray-800 font-medium">{{ auth()->user()->address ?? 'Not provided' }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Member Since</label>
                                    <p class="text-gray-800 font-medium">{{ auth()->user()->created_at->format('F d, Y') }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Account Status</label>
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Statistics -->
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
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Recent Activity</h3>
                    </div>
                    
                    <div class="space-y-6">
                        @forelse ($activities ?? [] as $activity)
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-shopping-bag text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $activity->description }}</p>
                                    <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-history text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500">No recent activity found</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>