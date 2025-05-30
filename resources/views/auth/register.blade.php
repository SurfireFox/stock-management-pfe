<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - Stock-Management-MedHK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
      <a class="navbar-brand" href="#">Stock-Management-MedHK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('register') }}">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Register Form -->
  <div class="container py-5">
    <h2 class="text-center mb-4">Register</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input
              type="text"
              class="form-control @error('firstname') is-invalid @enderror"
              id="firstname"
              name="firstname"
              value="{{ old('firstname') }}"
              required
            />
            @error('firstname')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input
              type="text"
              class="form-control @error('lastname') is-invalid @enderror"
              id="lastname"
              name="lastname"
              value="{{ old('lastname') }}"
              required
            />
            @error('lastname')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control @error('email') is-invalid @enderror"
              id="email"
              name="email"
              value="{{ old('email') }}"
              required
            />
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control @error('password') is-invalid @enderror"
              id="password"
              name="password"
              required
            />
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
