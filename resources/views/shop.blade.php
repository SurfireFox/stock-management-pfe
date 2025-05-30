<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stock-Management-MedHK - Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <style>
    body {
      background-color: #ffffff;
      color: #002f6c;
      font-family: Arial, sans-serif;
    }
    .navbar, footer {
      background-color: #002f6c;
    }
    .navbar a, footer, footer a {
      color: white !important;
    }
    .btn-primary {
      background-color: #0056b3;
      border: none;
    }
    .btn-primary:hover {
      background-color: #004494;
    }
    .product-card {
      border: 1px solid #e0e0e0;
      padding: 15px;
      border-radius: 5px;
      text-align: center;
    }
    .product-card img {
      max-height: 150px;
      object-fit: cover;
      margin-bottom: 10px;
    }
    footer {
      padding: 2rem 1rem;
      margin-top: 3rem;
      text-align: center;
    }
    #page-header {
      background-color: #e0e0e0;
      padding: 60px 20px;
      text-align: center;
    }
    #pagination a {
      margin: 0 5px;
      padding: 8px 16px;
      border: 1px solid #0056b3;
      color: #0056b3;
      text-decoration: none;
    }
    #pagination a:hover {
      background-color: #0056b3;
      color: white;
    }
    .newsletter {
      background-color: #f1f1f1;
      padding: 40px 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Stock-Managment-MedHK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
    <li class="nav-item"><a class="nav-link" href="/panier"><i class="fa fa-shopping-bag"></i></a></li>
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

  <!-- Page Header -->
  <section id="page-header">
    <h2>#StayAtHome</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
  </section>

  <!-- Products -->
  <section class="container my-5">
    <div class="row">
      <?php foreach ($produit as $produite): ?>
      <div class="col-md-3">
        <div class="product-card">
          <img src="{{ $produite->photo }}" alt="{{ $produite->name }}">
          <h5>{{ $produite->name }}</h5>
          <div class="text-warning">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            <i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <h4>{{ $produite->prix }}</h4>
          <a href="{{ url('/produitdetai/' . $produite->id) }}" class="btn btn-primary mt-2">View</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Pagination -->
  <div id="pagination" class="text-center mb-4">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
  </div>

  <!-- Newsletter -->
  <section class="newsletter">
    <h4>Sign Up for Newsletters</h4>
    <p>Get the latest updates and offers</p>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Your email address">
            <button class="btn btn-primary">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
