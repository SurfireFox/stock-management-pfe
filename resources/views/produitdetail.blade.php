<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $produit->name }} - Stock-Management-MedHK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
  <!-- Navbar -->
  <nav class="bg-blue-900 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="/" class="text-xl font-bold">Stock-Management-MedHK</a>
        <div class="hidden md:block">
          <div class="flex space-x-6">
            <a href="/" class="text-blue-200 hover:text-white transition-colors">Home</a>
            <a href="/shop" class="text-white font-medium transition-colors">Shop</a>
            <a href="/about" class="text-blue-200 hover:text-white transition-colors">About</a>
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

  <!-- Breadcrumb -->
  <div class="bg-white py-3 shadow-sm">
    <div class="container mx-auto px-4">
      <div class="flex items-center text-sm text-gray-500">
        <a href="/" class="hover:text-blue-600">Home</a>
        <span class="mx-2">/</span>
        <a href="/shop" class="hover:text-blue-600">Shop</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700 font-medium">{{ $produit->name }}</span>
      </div>
    </div>
  </div>

  <!-- produit Details Section -->
  <section class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="md:flex">
        <!-- produit Image -->
        <div class="md:w-1/2 relative">
          <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md">SALE</div>
          <img src="{{ asset($produit->photo) }}" class="w-full h-full object-cover" id="MainImg" alt="{{ $produit->name }}">
        </div>

        <!-- produit Details -->
        <div class="md:w-1/2 p-8">
          <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $produit->name }}</h1>
          {{-- <p class="text-gray-500 mb-4">produit Code: PRD-{{ $produit->id }}</p> --}}

          <div class="flex items-center mb-6">
            <span class="text-3xl font-bold text-blue-600">${{ $produit->prix }}</span>
            <span class="text-lg text-gray-400 line-through ml-2">${{ number_format($produit->prix * 1.2, 2) }}</span>
            {{-- <span class="ml-2 bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">20% OFF</span> --}}
          </div>

          <div class="mb-6">
            <p class="text-gray-600">{{ $produit->description }}</p>
          </div>

          <div class="flex items-center space-x-4 mb-8">
            <div class="w-24">
              <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
              <div class="flex">
                <button class="bg-gray-200 px-3 py-1 rounded-l-md hover:bg-gray-300">-</button>
                <input type="number" id="quantite" value="1" min="1"
                  class="w-full border-y border-gray-300 py-1 text-center focus:outline-none">
                <button class="bg-gray-200 px-3 py-1 rounded-r-md hover:bg-gray-300">+</button>
              </div>
            </div>

            <div class="flex-1">
              <button onclick="ajouterAuPanier('{{ $produit->id }}', '{{ $produit->name }}',    '{{ $produit->prix }}', '{{ asset($produit->photo) }}', document.getElementById('quantite').value)"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md transition duration-300 flex items-center justify-center">
                <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
              </button>
            </div>
          </div>

          <div class="border-t border-gray-200 pt-6 space-y-4">
            <div class="flex items-center">
              <i class="fas fa-truck text-blue-600 mr-3"></i>
              <span class="text-sm text-gray-600">Free shipping on orders over $50</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-undo text-blue-600 mr-3"></i>
              <span class="text-sm text-gray-600">30-day return policy</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-shield-alt text-blue-600 mr-3"></i>
              <span class="text-sm text-gray-600">2-year warranty</span>
            </div>
          </div>

          <div class="mt-6 flex space-x-4">
            <button class="flex items-center text-gray-500 hover:text-blue-600">
              <i class="far fa-heart mr-1"></i> Add to Wishlist
            </button>
            <button class="flex items-center text-gray-500 hover:text-blue-600">
              <i class="fas fa-share-alt mr-1"></i> Share
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- produit Details Tabs -->
  <section class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="border-b border-gray-200">
        <div class="flex">
          <button class="px-6 py-3 text-blue-600 border-b-2 border-blue-600 font-medium">Description</button>
          <button class="px-6 py-3 text-gray-500 hover:text-gray-700">Specifications</button>
          <button class="px-6 py-3 text-gray-500 hover:text-gray-700">Reviews (24)</button>
        </div>
      </div>
      <div class="p-6">
        <p class="text-gray-600">{{ $produit->description }}</p>
        <p class="text-gray-600 mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Sed euismod, nisl eget ultricies ultricies, nunc nisl ultricies nunc, eget ultricies nisl nisl eget ultricies ultricies.</p>
        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
          <li>Premium quality materials</li>
          <li>Durable and long-lasting</li>
          <li>Comfortable fit</li>
          <li>Easy to clean and maintain</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Related produits -->
  <section class="container mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">You May Also Like</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <!-- Sample related produits -->
      @for ($i = 1; $i <= 4; $i++)
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <div class="relative">
          <img src="https://via.placeholder.com/300x300" alt="Related produit" class="w-full h-64 object-cover">
          <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1 m-2 rounded">NEW</div>
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-1">Related produit {{ $i }}</h3>
          <div class="flex text-yellow-400 text-sm mb-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-blue-600 font-bold">${{ 19.99 + $i * 10 }}</span>
            <button class="text-gray-500 hover:text-blue-600">
              <i class="fas fa-shopping-cart"></i>
            </button>
          </div>
        </div>
      </div>
      @endfor
    </div>
  </section>

  <!-- Newsletter Section -->
  <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-6 md:mb-0">
          <h3 class="text-2xl font-bold mb-2">Sign Up for Newsletters</h3>
          <p class="text-blue-100">Get the latest updates and special offers delivered directly to your inbox.</p>
        </div>
        <div class="flex w-full md:w-auto">
          <input type="email" placeholder="Your email address"
            class="w-full md:w-64 px-4 py-3 rounded-l-md focus:outline-none">
          <button class="bg-blue-900 hover:bg-blue-950 text-white px-6 py-3 rounded-r-md transition duration-300 font-medium">
            Sign Up
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-100 pt-12 pb-6">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <!-- Contact Info -->
        <div>
          <h4 class="text-lg font-bold text-gray-800 mb-4">Contact</h4>
          <p class="text-gray-600 mb-2"><strong>Address:</strong> Lorem ipsum dolor sit</p>
          <p class="text-gray-600 mb-2"><strong>Phone:</strong> 13569876540</p>
          <p class="text-gray-600 mb-4"><strong>Hours:</strong> 9:00 AM - 6:00 PM</p>
          <h5 class="text-lg font-bold text-gray-800 mb-2">Follow Us</h5>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-gray-600 hover:text-blue-400 transition-colors"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-gray-600 hover:text-red-600 transition-colors"><i class="fab fa-pinterest"></i></a>
            <a href="#" class="text-gray-600 hover:text-red-600 transition-colors"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- About Links -->
        <div>
          <h4 class="text-lg font-bold text-gray-800 mb-4">About</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-600 hover:text-blue-600">About Us</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Delivery Information</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Privacy Policy</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Terms & Conditions</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Contact Us</a></li>
          </ul>
        </div>

        <!-- My Account Links -->
        <div>
          <h4 class="text-lg font-bold text-gray-800 mb-4">My Account</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Sign In</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">View Cart</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">My Wishlist</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Track My Order</a></li>
            <li><a href="#" class="text-gray-600 hover:text-blue-600">Help</a></li>
          </ul>
        </div>

        <!-- Install App -->
        <div>
          <h4 class="text-lg font-bold text-gray-800 mb-4">Install App</h4>
          <p class="text-gray-600 mb-2">From App Store or Google Play Store</p>
          <div class="flex space-x-2 mb-4">
            <a href="#" class="border border-gray-300 rounded-md p-2 hover:border-blue-600">
              <img src="img/pay/app.jpg" alt="App Store" class="h-8">
            </a>
            <a href="#" class="border border-gray-300 rounded-md p-2 hover:border-blue-600">
              <img src="img/pay/play.jpg" alt="Play Store" class="h-8">
            </a>
          </div>
          <p class="text-gray-600 mb-2">Secured Payment Gateways</p>
          <img src="img/pay/pay.png" alt="Payment Methods" class="h-6">
        </div>
      </div>

      <!-- Copyright -->
      <div class="border-t border-gray-200 pt-6 text-center">
        <p class="text-gray-600">&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
      </div>
    </div>
  </footer>

  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
  <script>
function ajouterAuPanier(id, name, prix, photo, quantite) {
    quantite = parseInt(quantite);
    if (isNaN(quantite) || quantite < 1) {
        alert("Quantité invalide !");
        return;
    }

    const produit = {
        id,
        name,
        prix: parseFloat(prix),
        photo,
        quantite
    };

    let panier = JSON.parse(localStorage.getItem("panier")) || [];

    const index = panier.findIndex(p => p.id === id);
    if (index !== -1) {
        panier[index].quantite += produit.quantite;
    } else {
        panier.push(produit);
    }

    localStorage.setItem("panier", JSON.stringify(panier));
    alert("Produit ajouté au panier !");
    // afficherPanier();
}

// Make sure the function is available globally
window.ajouterAuPanier = ajouterAuPanier;
</script>

</body>
</html>
