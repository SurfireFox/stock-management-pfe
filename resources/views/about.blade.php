<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Stock-Management-MedHK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-white text-blue-900 font-sans">
  <!-- Navbar -->
  <nav class="bg-blue-900 text-white shadow-md">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="/" class="text-xl font-bold">Stock-Management-MedHK</a>
        <div class="hidden md:block">
          <div class="flex space-x-6">
            <a href="/" class="text-blue-200 hover:text-white transition-colors">Home</a>
            <a href="/shop" class="text-blue-200 hover:text-white transition-colors">Shop</a>
            <a href="/about" class="text-white font-medium transition-colors">About</a>
            <a href="/contact" class="text-blue-200 hover:text-white transition-colors">Contact</a>
            @guest
              <a href="{{ route('login') }}" class="text-blue-200 hover:text-white transition-colors">Login</a>
              <a href="{{ route('register') }}" class="text-blue-200 hover:text-white transition-colors">Register</a>
            @else
              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-blue-200 hover:text-white transition-colors">Logout</button>
              </form>
            @endguest
          </div>
        </div>
        <button class="md:hidden text-white focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="bg-gradient-to-r from-blue-50 to-blue-100 py-20 text-center">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl font-bold text-blue-900 mb-4">About Stock-Management-MedHK</h1>
      <p class="text-xl text-blue-700 max-w-2xl mx-auto">Your trusted partner for efficient inventory control and product tracking.</p>
    </div>
  </div>

  <!-- Features Section -->
<div class="container mx-auto px-4 py-16">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Who We Are -->
    <div class="bg-white rounded-xl border-2 border-blue-500 shadow-lg p-6 mx-auto w-full flex flex-col items-center text-center transform transition-transform hover:scale-105 hover:shadow-xl">
      <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
        <i class="fas fa-users text-blue-600 text-2xl"></i>
      </div>
      <h2 class="text-xl font-bold text-blue-900 mb-2">Who We Are</h2>
      <p class="text-blue-700">We specialize in intuitive and powerful stock management solutions, helping businesses track inventory efficiently.</p>
    </div>

    <!-- Our Vision -->
    <div class="bg-white rounded-xl border-2 border-blue-500 shadow-lg p-6 mx-auto w-full flex flex-col items-center text-center transform transition-transform hover:scale-105 hover:shadow-xl">
      <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
        <i class="fas fa-eye text-blue-600 text-2xl"></i>
      </div>
      <h2 class="text-xl font-bold text-blue-900 mb-2">Our Vision</h2>
      <p class="text-blue-700">To lead the industry in adaptive, user-focused inventory management through innovation and reliability.</p>
    </div>

    <!-- Why Choose Us -->
    <div class="bg-white rounded-xl border-2 border-blue-500 shadow-lg p-6 mx-auto w-full flex flex-col items-center text-center transform transition-transform hover:scale-105 hover:shadow-xl">
      <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
        <i class="fas fa-check-circle text-blue-600 text-2xl"></i>
      </div>
      <h2 class="text-xl font-bold text-blue-900 mb-2">Why Choose Us?</h2>
      <ul class="text-blue-700 text-sm">
        <li class="flex items-center justify-center"><i class="fas fa-check text-blue-500 mr-1"></i> User-friendly interface</li>
        <li class="flex items-center justify-center"><i class="fas fa-check text-blue-500 mr-1"></i> Real-time monitoring</li>
        <li class="flex items-center justify-center"><i class="fas fa-check text-blue-500 mr-1"></i> Secure platform</li>
        <li class="flex items-center justify-center"><i class="fas fa-check text-blue-500 mr-1"></i> Reliable support</li>
      </ul>
    </div>
  </div>
</div>
  <!-- Footer -->
  <footer class="bg-blue-900 text-white py-6 text-center">
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>
</body>
</html>
