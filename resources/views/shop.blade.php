<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stock-Management-MedHK - Shop</title>
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
            <a href="/shop" class="text-white font-medium transition-colors">Shop</a>
            <a href="/about" class="text-blue-200 hover:text-white transition-colors">About</a>
            <a href="/contact" class="text-blue-200 hover:text-white transition-colors">Contact</a>
            <a href="/panier" class="text-blue-200 hover:text-white transition-colors">
              <i class="fa fa-shopping-bag"></i>
            </a>
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

  <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-500 to-blue-700 py-20 text-center text-white">
        <h2 class="text-4xl font-bold mb-3">#ShopWithUs</h2>
        <p class="text-blue-100 max-w-lg mx-auto">Discover our latest collection of high-quality produits at unbeatable prices.</p>
    </section>


  <!-- Filter Bar -->
  <section class="container mx-auto px-4 py-6">
    <div class="flex flex-wrap justify-between items-center">
      <div class="mb-4 md:mb-0">
        <span class="text-gray-600 mr-2">Filter:</span>
        <select class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option>All produits</option>
          <option>New Arrivals</option>
          <option>Best Sellers</option>
          <option>Price: Low to High</option>
          <option>Price: High to Low</option>
        </select>
      </div>
      <div class="flex items-center">
        <span class="text-gray-600 mr-2">View:</span>
        <button class="p-2 text-blue-600"><i class="fas fa-th-large"></i></button>
        <button class="p-2 text-gray-400"><i class="fas fa-list"></i></button>
      </div>
    </div>
  </section>

  <!-- produits -->
  <section class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($produit as $produite)
      <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <a href="{{ url('/produitdetai/' . $produite->id) }}">
          <img src="{{ $produite->photo }}" alt="{{ $produite->name }}" class="w-full h-48 object-cover">
        </a>
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-1">{{ $produite->name }}</h3>
          <div class="flex text-yellow-400 text-sm mb-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-blue-600 font-bold">{{ $produite->price }}</span>
            <a href="{{ url('/produitdetail/' . $produite->id) }}"
              class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md transition duration-300">
              View
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Pagination -->
  <div class="flex justify-center items-center space-x-2 my-8">
    <a href="#" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors">1</a>
    <a href="#" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors">2</a>
    <a href="#" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors">
      <i class="fa fa-long-arrow-right"></i>
    </a>
  </div>

  <!-- Newsletter -->
  <section class="bg-gray-100 py-12">
    <div class="container mx-auto px-4 text-center">
      <h4 class="text-2xl font-bold mb-2">Sign Up for Newsletters</h4>
      <p class="text-gray-600 mb-6">Get the latest updates and offers</p>
      <div class="max-w-md mx-auto flex">
        <input type="email" placeholder="Your email address"
          class="flex-1 px-4 py-2 rounded-l-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-r-md transition duration-300">
          Sign Up
        </button>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white py-8 text-center">
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>
</body>
</html>
