<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - Stock-Management-MedHK</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex flex-col bg-gray-50 text-blue-900 font-sans">
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
            <a href="{{ route('login') }}" class="text-blue-200 hover:text-white transition-colors">Login</a>
            <a href="{{ route('register') }}" class="text-white font-medium">Register</a>
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

  <!-- Main Content -->
  <main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden">
      <div class="bg-blue-600 py-4">
        <h2 class="text-center text-2xl font-bold text-white">Create Account</h2>
      </div>
      <div class="p-8">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
              <input
                type="text"
                class="w-full px-3 py-2 border rounded-md @error('firstname') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="firstname"
                name="firstname"
                value="{{ old('firstname') }}"
                required
              >
              @error('firstname')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
              <input
                type="text"
                class="w-full px-3 py-2 border rounded-md @error('lastname') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="lastname"
                name="lastname"
                value="{{ old('lastname') }}"
                required
              >
              @error('lastname')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input
              type="email"
              class="w-full px-3 py-2 border rounded-md @error('email') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
              id="email"
              name="email"
              value="{{ old('email') }}"
              required
            >
            @error('email')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input
              type="password"
              class="w-full px-3 py-2 border rounded-md @error('password') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500"
              id="password"
              name="password"
              required
            >
            @error('password')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-8">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input
              type="password"
              class="w-full px-3 py-2 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
              id="password_confirmation"
              name="password_confirmation"
              required
            >
          </div>

          <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300"
          >
            Create Account
          </button>

          <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Sign in</a></p>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white py-6 text-center">
    <p>&copy; 2025 Stock-Management-MedHK. All rights reserved.</p>
  </footer>
</body>
</html>
