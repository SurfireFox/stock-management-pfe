<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock-Management-MedHK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-white text-blue-900 font-sans">
  <!-- Navbar -->
  <nav class="bg-blue-900 text-white">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="/" class="text-xl font-bold">Stock-Management-MedHK</a>
        <div class="hidden md:block">
          <div class="flex space-x-6">
            <a href="/" class="text-white font-medium">Home</a>
            <a href="/shop" class="text-blue-200 hover:text-white">Shop</a>
            <a href="/about" class="text-blue-200 hover:text-white">About</a>
            <a href="/contact" class="text-blue-200 hover:text-white">Contact</a>
            @guest
              <a href="{{ route('login') }}" class="text-blue-200 hover:text-white">Login</a>
              <a href="{{ route('register') }}" class="text-blue-200 hover:text-white">Register</a>
            @else
              <a href="/userdashboard" class="text-blue-200 hover:text-white">Dashboard</a>
              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-blue-200 hover:text-white">Logout</button>
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
  <header class="bg-gradient-to-r from-blue-50 to-blue-100 py-20 text-center relative overflow-hidden">
  <div class="absolute inset-0 bg-pattern opacity-10"></div>
  <div class="container mx-auto px-4 relative z-10">
    <span class="inline-block bg-blue-600 text-white text-sm font-semibold px-4 py-1 rounded-full mb-4">Limited Time Offer</span>
    <h2 class="text-3xl font-bold mb-2 text-blue-800">Super Value Deals</h2>
    <h1 class="text-5xl md:text-6xl font-extrabold mb-4 text-blue-900">
      On All <span class="text-blue-600">Products</span>
    </h1>
    <p class="text-gray-600 mb-8 max-w-md mx-auto">Save up to 50% on our entire collection. Don't miss these amazing deals!</p>
    <div class="flex justify-center space-x-4">
      <a href="/shop" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-md transition duration-300 shadow-md hover:shadow-lg flex items-center">
        Shop Now <i class="fas fa-arrow-right ml-2"></i>
      </a>
      <a href="/about" class="bg-white hover:bg-gray-100 text-blue-600 font-medium py-3 px-8 rounded-md transition duration-300 shadow-md hover:shadow-lg border border-blue-200">
        Learn More
      </a>
    </div>
  </div>
</header>

  <!-- categories -->
  <section class="py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($categorie as $categoriee)
        <div class="text-center group">
          <div class="overflow-hidden rounded-lg mb-3 shadow-md">
            <img src="{{ $categoriee->photo }}" alt="{{ $categoriee->name }}"
              class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
          </div>
          <h6 class="font-semibold text-lg">{{ $categoriee->name }}</h6>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-10">Featured Products</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($produit as $produite)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
          <div class="h-48 overflow-hidden">
            <img src="{{ $produite->photo }}" alt="{{ $produite->name }}" class="w-full h-full object-cover">
          </div>
          <div class="p-4">
            <h5 class="font-semibold text-lg mb-2">{{ $produite->name }}</h5>
            <p class="text-blue-600 font-bold mb-4">{{ $produite->prix }}</p>
            <a href="{{ url('/produitdetail/' . $produite->id) }}"
              class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
              View
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white py-8">
    <div class="container mx-auto px-4 text-center">
      <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
