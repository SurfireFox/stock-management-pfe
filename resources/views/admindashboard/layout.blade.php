<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('extra_css')
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-gray-900 text-white fixed left-0 top-0 overflow-y-auto">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
                <div class="border-t border-gray-700 my-4"></div>
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">
                        <span class="text-lg font-bold">A</span>
                    </div>
                    <div>
                        <p class="font-medium">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-sm text-gray-400">Administrator</p>
                    </div>
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="/admin/dashboard" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-gray-800' : 'hover:bg-gray-800' }} transition-colors">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/users" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->is('admin/users*') ? 'bg-gray-800' : 'hover:bg-gray-800' }} transition-colors">
                                <i class="fas fa-users"></i>
                                <span>Users Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/usersorders" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->is('admin/orders*') ? 'bg-gray-800' : 'hover:bg-gray-800' }} transition-colors">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/history" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->is('admin/history*') ? 'bg-gray-800' : 'hover:bg-gray-800' }} transition-colors">
                                <i class="fas fa-history"></i>
                                <span>User History</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/profile" class="flex items-center space-x-3 p-3 rounded-lg {{ request()->is('admin/profile*') ? 'bg-gray-800' : 'hover:bg-gray-800' }} transition-colors">
                                <i class="fas fa-user-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="border-t border-gray-700 my-6"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-colors w-full">
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
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page_title')</h1>
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
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
