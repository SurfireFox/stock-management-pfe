<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Details - Stock-Managment-MedHK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
  <script src="https://use.fontawesome.com/dfba0bb4d8.js"></script>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Stock-Management-MedHK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
    @guest
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
    @else
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="nav-link btn btn-link" type="submit">Logout</button>
        </form>
      </li>
    @endguest
</ul>

      </div>
    </div>
  </nav>

  <section id="prodetails" class="section-p1">
    <div class="single-pro-image">
      <img src="{{ asset($produit->photo) }}" width="100%" id="MainImg" alt="{{ $produit->name }}">
    </div>

    <div class="single-pro-details">
      <h4 class="product-title">{{ $produit->name }}</h4>
      <h2 class="product-price">{{ $produit->prix }}$</h2>

      <div class="product-options">
        <select class="size-select">
          <option disabled selected>Select Size</option>
          <option>S</option>
          <option>M</option>
          <option>L</option>
          <option>XL</option>
          <option>XXL</option>
        </select>

        <div class="quantity-wrapper">
          <input type="number" id="quantite" value="1" min="1">
          <button class="normal" onclick="ajouterAuPanier('{{ $produit->id }}', '{{ $produit->name }}', '{{ $produit->prix }}', '{{ asset($produit->photo) }}', document.getElementById('quantite').value)">
            Add to Cart
          </button>
        </div>
      </div>

      <div class="product-description">
        <h4>Product Details</h4>
        <span>{{ $produit->description }}</span>
      </div>
    </div>
  </section>

  <section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <div class="pro-container">
      <!-- Featured products dynamically inserted here -->
    </div>
  </section>

  <section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
      <h4>Sign Up for Newsletters</h4>
      <p>Get the latest updates and special offers delivered directly to your inbox.</p>
    </div>
    <div class="form">
      <input type="text" placeholder="Your email address">
      <button class="normal">Sign Up</button>
    </div>
  </section>

  <footer class="section-p1">
    <div class="col">
      <img class="logo" src="" alt="">
      <h4>Contact</h4>
      <p><strong>Address:</strong> Lorem ipsum dolor sit</p>
      <p><strong>Phone:</strong> 13569876540</p>
      <p><strong>Hours:</strong> 5hoai</p>
      <div class="follow">
        <h4>Follow Us</h4>
        <div class="icon">
          <i class="fab fa-facebook-f"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-instagram"></i>
          <i class="fab fa-pinterest-p"></i>
          <i class="fab fa-youtube"></i>
        </div>
      </div>
    </div>

    <div class="col">
      <h4>About</h4>
      <a href="#">About Us</a>
      <a href="#">Delivery Information</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">Contact Us</a>
    </div>

    <div class="col">
      <h4>My Account</h4>
      <a href="#">Sign In</a>
      <a href="#">View Cart</a>
      <a href="#">My Wishlist</a>
      <a href="#">Track My Order</a>
      <a href="#">Help</a>
    </div>

    <div class="col install">
      <h4>Install App</h4>
      <p>From App Store or Google Play Store</p>
      <div class="row">
        <img src="img/pay/app.jpg" alt="">
        <img src="img/pay/play.jpg" alt="">
      </div>
      <p>Secured Payment Gateways</p>
      <img src="img/pay/pay.png" alt="">
    </div>

    <div class="copyright">
      <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
    </div>
  </footer>

  <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
