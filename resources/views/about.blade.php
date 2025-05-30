<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Stock-Management-MedHK</title>
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

    .hero {
      background-color: #e6f0ff;
      padding: 80px 20px;
      text-align: center;
    }

    .bubble-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 40px;
      padding: 60px 20px;
    }

    .bubble {
      background-color: #f0f8ff;
      border: 2px solid #0056b3;
      border-radius: 50%;
      width: 300px;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0, 47, 108, 0.2);
      transition: transform 0.3s ease;
    }

    .bubble:hover {
      transform: scale(1.05);
    }

    .bubble h2 {
      font-size: 1.5rem;
      margin-bottom: 10px;
    }

    .bubble p,
    .bubble ul {
      font-size: 1rem;
    }

    .bubble ul {
      list-style: none;
      padding: 0;
    }

    .bubble ul li::before {
      content: "✔ ";
      color: #0056b3;
    }

    footer {
      padding: 20px;
      text-align: center;
    }

    @media (max-width: 768px) {
      .bubble-container {
        gap: 20px;
        padding: 30px 10px;
      }

      .bubble {
        width: 90%;
        height: auto;
        border-radius: 20px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Stock-Management-MedHK</a>
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

  <!-- Hero Section -->
  <div class="hero">
    <h1>About Stock-Management-MedHK</h1>
    <p>Your trusted partner for efficient inventory control and product tracking.</p>
  </div>

  <!-- Bubbles Section -->
  <div class="bubble-container">
    <div class="bubble">
      <div>
        <h2>Who We Are</h2>
        <p>We specialize in intuitive and powerful stock management solutions, helping businesses track inventory and reduce waste efficiently.</p>
      </div>
    </div>
    <div class="bubble">
      <div>
        <h2>Our Vision</h2>
        <p>To lead the industry in adaptive, user-focused inventory management through innovation and reliability.</p>
      </div>
    </div>
    <div class="bubble">
      <div>
        <h2>Why Choose Us?</h2>
        <ul>
          <li>User-friendly interface</li>
          <li>Real-time inventory monitoring</li>
          <li>Secure and scalable platform</li>
          <li>Reliable customer support</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
