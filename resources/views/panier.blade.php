<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart - Stock-Management-MedHK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
  <!-- Navbar -->
  <nav class="bg-blue-900 text-white shadow-md">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="/" class="text-xl font-bold">Stock-Management-MedHK</a>
        <div class="hidden md:block">
          <div class="flex space-x-6">
            <a href="/" class="text-blue-200 hover:text-white transition-colors">Home</a>
            <a href="/shop" class="text-blue-200 hover:text-white transition-colors">Shop</a>
            <a href="/about" class="text-blue-200 hover:text-white transition-colors">About</a>
            <a href="/contact" class="text-blue-200 hover:text-white transition-colors">Contact</a>
            <a href="/panier" class="text-white font-medium">
              <i class="fas fa-shopping-cart"></i>
              <span class="ml-1">Cart</span>
              <span class="bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 ml-1">{{ count(session('cart', [])) }}</span>
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
  <div class="bg-gradient-to-r from-blue-50 to-blue-100 py-8">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl font-bold text-blue-900 text-center">Your Shopping Cart</h1>
      <div class="flex justify-center mt-2">
        <nav class="flex" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a href="/" class="text-blue-600 hover:text-blue-800">Home</a>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-500 ml-1 md:ml-2">Cart</span>
              </div>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <!-- Cart Content -->
  <div class="container mx-auto px-4 py-8 flex-grow">
    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Cart Items -->
      <div class="lg:w-2/3">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
          <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Shopping Cart ({{ count(session('cart', [])) }} items)</h2>
          </div>

          @if(count(session('cart', [])) > 0)
            @php
              $total = 0;
              $shipping = 4.99;
              $tax = 0;
            @endphp

            @foreach(session('cart', []) as $id => $details)
              @php
                $itemTotal = $details['price'] * $details['quantity'];
                $total += $itemTotal;
                $tax = $total * 0.08; // 8% tax
              @endphp
              <div class="p-4 border-b border-gray-200" id="cart-item-{{ $id }}">
                <div class="flex flex-col md:flex-row items-center gap-4">
                  <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ asset($details['photo']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                  </div>
                  <div class="flex-grow">
                    <h3 class="text-lg font-medium text-gray-800">{{ $details['name'] }}</h3>
                    <p class="text-sm text-gray-500">
                      @if(isset($details['attributes']))
                        @foreach($details['attributes'] as $key => $value)
                          {{ ucfirst($key) }}: {{ $value }}
                          @if(!$loop->last) | @endif
                        @endforeach
                      @endif
                    </p>
                    <div class="flex items-center mt-2">
                      <div class="flex border border-gray-300 rounded-md">
                        <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 update-cart" data-id="{{ $id }}" data-action="decrease">-</button>
                        <input type="number" value="{{ $details['quantity'] }}" min="1" class="w-12 text-center border-x border-gray-300 py-1 cart-quantity" data-id="{{ $id }}" readonly>
                        <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 update-cart" data-id="{{ $id }}" data-action="increase">+</button>
                      </div>
                      <button class="ml-4 text-red-500 hover:text-red-700 remove-from-cart" data-id="{{ $id }}">
                        <i class="fas fa-trash"></i> Remove
                      </button>
                    </div>
                  </div>
                  <div class="text-right">
                    <p class="text-lg font-semibold text-blue-600">${{ number_format($details['price'], 2) }}</p>
                    <p class="text-sm text-gray-500">Subtotal: ${{ number_format($itemTotal, 2) }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="p-8 text-center">
              <div class="flex flex-col items-center">
                <div class="text-gray-300 mb-4">
                  <i class="fas fa-shopping-cart text-6xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-6">Looks like you haven't added any products to your cart yet.</p>
                <a href="/shop" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-300">
                  Start Shopping
                </a>
              </div>
            </div>
          @endif
        </div>

        @if(count(session('cart', [])) > 0)
          <!-- Continue Shopping -->
          <div class="mt-6 flex justify-between">
            <a href="/shop" class="flex items-center text-blue-600 hover:text-blue-800 transition duration-300">
              <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
            </a>
            <button id="clear-cart" class="text-red-500 hover:text-red-700 flex items-center transition duration-300">
              <i class="fas fa-trash mr-2"></i> Clear Cart
            </button>
          </div>
        @endif
      </div>

      @if(count(session('cart', [])) > 0)
        <!-- Order Summary -->
        <div class="lg:w-1/3">
          <div class="bg-white rounded-xl shadow-md p-6 sticky top-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>

            <div class="space-y-3 mb-6">
              <div class="flex justify-between">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium">${{ number_format($total, 2) }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Shipping</span>
                <span class="font-medium">${{ number_format($shipping, 2) }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Tax (8%)</span>
                <span class="font-medium">${{ number_format($tax, 2) }}</span>
              </div>
              <div class="border-t border-gray-200 pt-3 flex justify-between">
                <span class="text-lg font-semibold">Total</span>
                <span class="text-lg font-bold text-blue-600">${{ number_format($total + $shipping + $tax, 2) }}</span>
              </div>
            </div>

            <!-- Coupon Code -->
            <div class="mb-6">
              <label for="coupon" class="block text-sm font-medium text-gray-700 mb-1">Coupon Code</label>
              <div class="flex">
                <input type="text" id="coupon" class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter coupon">
                <button id="apply-coupon" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-r-md transition duration-300">Apply</button>
              </div>
            </div>

            <!-- Checkout Button -->
            <a href="/checkout" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 rounded-md transition duration-300">
              Proceed to Checkout
            </a>

            <!-- Estimated Delivery -->
            <div class="mt-4 text-center text-sm text-gray-500">
              <p>Estimated delivery: <span class="font-medium">{{ date('M d', strtotime('+3 days')) }} - {{ date('M d', strtotime('+7 days')) }}</span></p>
            </div>
          </div>

          <!-- Payment Methods -->
          <div class="mt-6 bg-white rounded-xl shadow-md p-4">
            <h3 class="text-sm font-medium text-gray-700 mb-3">We Accept</h3>
            <div class="flex space-x-2">
              <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg" alt="Visa" class="h-8">
              <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg" alt="Mastercard" class="h-8">
              <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/paypal/paypal-original.svg" alt="PayPal" class="h-8">
              <div class="h-8 w-8 bg-black rounded flex items-center justify-center">
                <i class="fab fa-apple text-white text-xl"></i>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white mt-12">
    <div class="container mx-auto px-4 py-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h4 class="text-lg font-bold mb-4">Contact</h4>
          <p class="mb-2"><strong>Address:</strong> Lorem ipsum dolor sit</p>
          <p class="mb-2"><strong>Phone:</strong> 13569876540</p>
          <p class="mb-4"><strong>Hours:</strong> 9:00 AM - 6:00 PM</p>
          <h5 class="text-lg font-bold mb-2">Follow Us</h5>
          <div class="flex space-x-4">
            <a href="#" class="text-white hover:text-blue-200"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white hover:text-blue-200"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white hover:text-blue-200"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white hover:text-blue-200"><i class="fab fa-pinterest"></i></a>
            <a href="#" class="text-white hover:text-blue-200"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <div>
          <h4 class="text-lg font-bold mb-4">About</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-blue-200 hover:text-white">About Us</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">Delivery Information</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">Privacy Policy</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">Terms & Conditions</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">Contact Us</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-bold mb-4">My Account</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-blue-200 hover:text-white">Sign In</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">View Cart</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">My Wishlist</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">Track My Order</a></li>
            <li><a href="#" class="text-blue-200 hover:text-white">Help</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-bold mb-4">Install App</h4>
          <p class="text-blue-200 mb-2">From App Store or Google Play Store</p>
          <div class="flex space-x-2 mb-4">
            <a href="#" class="bg-white p-2 rounded">
              <img src="img/pay/app.jpg" alt="App Store" class="h-8">
            </a>
            <a href="#" class="bg-white p-2 rounded">
              <img src="img/pay/play.jpg" alt="Play Store" class="h-8">
            </a>
          </div>
          <p class="text-blue-200 mb-2">Secured Payment Gateways</p>
          <div class="bg-white p-2 rounded inline-block">
            <img src="img/pay/pay.png" alt="Payment Methods" class="h-6">
          </div>
        </div>
      </div>

      <div class="border-t border-blue-800 mt-8 pt-6 text-center">
        <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Update cart quantity
      $('.update-cart').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var action = $(this).data('action');
        var quantityElement = $(this).closest('.flex').find('.cart-quantity');
        var currentQuantity = parseInt(quantityElement.val());

        if (action === 'increase') {
          var quantity = currentQuantity + 1;
        } else if (action === 'decrease') {
          var quantity = currentQuantity > 1 ? currentQuantity - 1 : 1;
        }

        if (quantity !== currentQuantity) {
          $.ajax({
            url: '/update-cart',
            method: "PATCH",
            data: {
              _token: '{{ csrf_token() }}',
              id: id,
              quantity: quantity
            },
            success: function (response) {
              window.location.reload();
            }
          });
        }
      });

      // Remove from cart
      $('.remove-from-cart').click(function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var element = $(this).closest('#cart-item-' + id);

        if(confirm("Are you sure you want to remove this item?")) {
          $.ajax({
            url: '/remove-from-cart',
            method: "DELETE",
            data: {
              _token: '{{ csrf_token() }}',
              id: id
            },
            success: function (response) {
              element.fadeOut(300, function() {
                $(this).remove();
                window.location.reload();
              });
            }
          });
        }
      });

      // Clear cart
      $('#clear-cart').click(function(e) {
        e.preventDefault();

        if(confirm("Are you sure you want to clear your cart?")) {
          $.ajax({
            url: '/clear-cart',
            method: "DELETE",
            data: {
              _token: '{{ csrf_token() }}'
            },
            success: function (response) {
              window.location.reload();
            }
          });
        }
      });

      // Apply coupon
      $('#apply-coupon').click(function(e) {
        e.preventDefault();

        var coupon = $('#coupon').val();
        if (coupon) {
          $.ajax({
            url: '/apply-coupon',
            method: "POST",
            data: {
              _token: '{{ csrf_token() }}',
              coupon: coupon
            },
            success: function (response) {
              if (response.success) {
                alert('Coupon applied successfully!');
                window.location.reload();
              } else {
                alert('Invalid coupon code.');
              }
            }
          });
        } else {
          alert('Please enter a coupon code.');
        }
      });
    });
  </script>
</body>
</html>
