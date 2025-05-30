<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - Stock-Management-MedHK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/dfba0bb4d8.js"></script>
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

  <!-- Contact Section -->
  <section class="container py-5">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-5 text-primary">Get in Touch</h2>
      <p class="text-muted fs-5">We’d love to hear from you. Fill out the form or reach out using the details below.</p>
    </div>
    <div class="row align-items-center g-5">
      <div class="col-md-6">
        <div class="bg-light p-4 rounded shadow-sm">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Your Name">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Your Email">
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="subject" placeholder="Subject">
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Message</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-white p-4 rounded shadow-sm border">
          <h5 class="fw-bold mb-3">Contact Information</h5>
          <p><i class="fa fa-map-marker me-2 text-primary"></i> 123 Stock Street, MedHK</p>
          <p><i class="fa fa-phone me-2 text-primary"></i> +213 123 456 789</p>
          <p><i class="fa fa-envelope me-2 text-primary"></i> support@stock-medhk.com</p>
          <hr>
          <h6 class="fw-semibold">Business Hours</h6>
          <p>Monday to Friday: 9:00 AM - 6:00 PM</p>
          <p>Saturday & Sunday: Closed</p>
          <hr>
          <h6 class="fw-semibold">Follow Us</h6>
          <div class="d-flex gap-3">
            <a href="#" class="text-decoration-none text-dark"><i class="fab fa-facebook fa-lg"></i></a>
            <a href="#" class="text-decoration-none text-dark"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="#" class="text-decoration-none text-dark"><i class="fab fa-instagram fa-lg"></i></a>
            <a href="#" class="text-decoration-none text-dark"><i class="fab fa-linkedin fa-lg"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
