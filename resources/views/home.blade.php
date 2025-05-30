<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Youshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="text-center py-5 bg-light">
    <h4>Trade-in Offer</h4>
    <h2>Super Value Deals</h2>
    <h1>On All Products</h1>
    <p>Lorem ipsum dolor</p>
    <a class="btn btn-primary" href="/shop">Shop Now</a>
  </header>

  <!-- Categories -->
  <section class="container my-5">
    <div class="row">
      @foreach ($categorie as $categoriee)
      <div class="col-md-3 text-center">
        <img src="{{ $categoriee->photo }}" alt="{{ $categoriee->name }}" class="img-fluid">
        <h6>{{ $categoriee->name }}</h6>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Featured Products -->
  <section class="container my-5">
    <h2 class="text-center">Featured Products</h2>
    <div class="row">
      @foreach ($produit as $produite)
      <div class="col-md-3">
        <div class="product-card">
          <img src="{{ $produite->photo }}" alt="{{ $produite->name }}">
          <h5>{{ $produite->name }}</h5>
          <p>{{ $produite->prix }}</p>
          <a class="btn btn-primary" href="{{ url('/produitdetai/' . $produite->id) }}">View</a>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Newsletter -->
  <section class="bg-light py-5 text-center">
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
    <p>&copy; 2025 Stock-Managment-MedHK. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
