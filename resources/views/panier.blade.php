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
                            <a href="/userprofile" class="text-blue-200 hover:text-white transition-colors">
                                <i class="fas fa-user"></i>
                                <span class="ml-1">Profile</span>
                            </a>
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
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Shopping Cart (<span id="cart-count">0</span> items)</h2>
                        <button id="clear-cart" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center">
                            <i class="fas fa-trash-alt mr-1"></i> Clear Cart
                        </button>
                    </div>

                    <div class="p-4">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2">Product</th>
                                    <th class="py-2">Quantity</th>
                                    <th class="py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody id="panier-items">
                                <!-- Cart rows inserted by JavaScript -->
                            </tbody>
                            <tfoot>
                                <tr class="total-price border-t">
                                    <td colspan="2" class="text-right font-bold py-2">Grand Total</td>
                                    <td class="py-2 font-bold text-blue-600">0$</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <a href="/shop" class="flex items-center text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                    </a>
                    <a href="/checkout" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                        Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Order Summary</h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium" id="subtotal">0$</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">Free</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium" id="tax">0$</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between">
                            <span class="font-bold">Total</span>
                            <span class="font-bold text-blue-600" id="total">0$</span>
                        </div>
                    </div>
                </div>


            </div>
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
                        success: function(response) {
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

                if (confirm("Are you sure you want to remove this item?")) {
                    $.ajax({
                        url: '/remove-from-cart',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
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

                if (confirm("Are you sure you want to clear your cart?")) {
                    $.ajax({
                        url: '/clear-cart',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
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
                        success: function(response) {
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
    <script>
        function afficherPanier() {
            const panierTable = document.getElementById("panier-items");
            const totalPriceEl = document.querySelector(".total-price td:last-child");
            const cartCount = document.getElementById("cart-count");
            const subtotalEl = document.getElementById("subtotal");
            const taxEl = document.getElementById("tax");
            const totalEl = document.getElementById("total");

            let panier = JSON.parse(localStorage.getItem("panier")) || [];
            let grandTotal = 0;

            if (!panierTable) return;

            panierTable.innerHTML = "";

            panier.forEach(produit => {
                const itemTotal = parseFloat(produit.prix) * produit.quantite;
                grandTotal += itemTotal;
                const assetBase = "{{ asset('storage') }}"

                const row = `
                <tr class="hover:bg-gray-50">
                    <td class="py-4 pr-4">
                        <div class="flex items-center space-x-3">
                            <img src="${assetBase}/${produit.photo}" alt="${produit.name}" class="w-16 h-16 object-cover rounded">
                            <div>
                                    <p class="font-medium text-gray-800">${produit.name}</p>
                                <p class="text-sm text-gray-500">Price: ${produit.prix}$</p>
                                <button onclick="removeProduit('${produit.id}'); return false;" class="text-red-500 hover:text-red-700 text-sm mt-1 flex items-center">
                                    <i class="fas fa-trash-alt mr-1"></i> Remove
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center border rounded-md w-24">
                            <button onclick="updateQuantite('${produit.id}', ${Math.max(1, produit.quantite - 1)})" class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" value="${produit.quantite}" class="w-8 text-center border-0 focus:outline-none" readonly>
                            <button onclick="updateQuantite('${produit.id}', ${produit.quantite + 1})" class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </td>
                    <td class="py-4 font-medium">${itemTotal.toFixed(2)}$</td>
                </tr>
                `;

                panierTable.innerHTML += row;
            });

            if (panier.length === 0) {
                panierTable.innerHTML = `
                <tr>
                    <td colspan="3" class="py-8 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-shopping-cart text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 mb-4">Your cart is empty</p>
                            <a href="/shop" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                Start Shopping
                            </a>
                        </div>
                    </td>
                </tr>
                `;
            }

            if (totalPriceEl) {
                totalPriceEl.textContent = `${grandTotal.toFixed(2)}$`;
            }

            if (cartCount) {
                cartCount.textContent = panier.length;
            }

            // Update order summary
            if (subtotalEl) {
                subtotalEl.textContent = `${grandTotal.toFixed(2)}$`;
            }

            const tax = grandTotal * 0.05;
            if (taxEl) {
                taxEl.textContent = `${tax.toFixed(2)}$`;
            }

            if (totalEl) {
                totalEl.textContent = `${(grandTotal + tax).toFixed(2)}$`;
            }
        }

        // Call this when the page loads
        document.addEventListener("DOMContentLoaded", afficherPanier);

        // Implement removeProduit and updateQuantite
        function removeProduit(id) {
            let panier = JSON.parse(localStorage.getItem("panier")) || [];
            panier = panier.filter(p => p.id !== id);
            localStorage.setItem("panier", JSON.stringify(panier));
            afficherPanier();
        }

        function updateQuantite(id, quantite) {
            let panier = JSON.parse(localStorage.getItem("panier")) || [];
            const index = panier.findIndex(p => p.id === id);
            if (index !== -1) {
                panier[index].quantite = parseInt(quantite);
                localStorage.setItem("panier", JSON.stringify(panier));
                afficherPanier();
            }
        }
    </script>
</body>
</html>
