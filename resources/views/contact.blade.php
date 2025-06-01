<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - Stock-Management-MedHK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 text-blue-900 font-sans">
  <!-- Navbar -->
  <nav class="bg-blue-900 text-white">
    <div class="container mx-auto px-4 py-3">
      <div class="flex justify-between items-center">
        <a href="/" class="text-xl font-bold">Stock-Management-MedHK</a>
        <div class="hidden md:block">
          <div class="flex space-x-6">
            <a href="/" class="hover:text-blue-200">Home</a>
            <a href="/shop" class="hover:text-blue-200">Shop</a>
            <a href="/about" class="hover:text-blue-200">About</a>
            <a href="/contact" class="text-blue-200 font-medium">Contact</a>
            @guest
              <a href="{{ route('login') }}" class="hover:text-blue-200">Login</a>
              <a href="{{ route('register') }}" class="hover:text-blue-200">Register</a>
            @else
              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:text-blue-200">Logout</button>
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

  <!-- Contact Section -->
  <section class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-blue-600 mb-3">Get in Touch</h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">We'd love to hear from you. Fill out the form or reach out using the details below.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
      <!-- Contact Form -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <form>
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" id="name" placeholder="Your Name" 
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" placeholder="Your Email" 
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-4">
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input type="text" id="subject" placeholder="Subject" 
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-6">
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea id="message" rows="5" placeholder="Your Message" 
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
          </div>
          <button type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
            Send Message
          </button>
        </form>
      </div>
      
      <!-- Contact Information -->
      <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Contact Information</h3>
        <div class="space-y-4 mb-6">
          <div class="flex items-start">
            <div class="text-blue-600 mt-1">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="ml-4">
              <p class="text-gray-700">123 Stock Street, MedHK</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="text-blue-600 mt-1">
              <i class="fas fa-phone"></i>
            </div>
            <div class="ml-4">
              <p class="text-gray-700">+213 123 456 789</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="text-blue-600 mt-1">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="ml-4">
              <p class="text-gray-700">support@stock-medhk.com</p>
            </div>
          </div>
        </div>
        
        <div class="border-t border-gray-200 pt-4 mb-6">
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Business Hours</h4>
          <p class="text-gray-700">Monday to Friday: 9:00 AM - 6:00 PM</p>
          <p class="text-gray-700">Saturday & Sunday: Closed</p>
        </div>
        
        <div class="border-t border-gray-200 pt-4">
          <h4 class="text-lg font-semibold text-gray-800 mb-3">Follow Us</h4>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">
              <i class="fab fa-facebook-f text-xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-blue-400 transition-colors">
              <i class="fab fa-twitter text-xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors">
              <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-blue-800 transition-colors">
              <i class="fab fa-linkedin-in text-xl"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Map Section -->
  <section class="container mx-auto px-4 py-8">
    <div class="bg-gray-200 h-64 rounded-lg overflow-hidden">
      <!-- Replace with actual map embed code -->
      <div class="w-full h-full flex items-center justify-center text-gray-500">
        <p>Map will be displayed here</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white mt-12 py-8">
    <div class="container mx-auto px-4 text-center">
      <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>