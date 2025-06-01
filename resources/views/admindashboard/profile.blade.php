@extends('admindashboard.layout')

@section('title', 'Admin Profile')
@section('page_title', 'My Profile')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Profile Information -->
    <div class="md:col-span-1">
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex flex-col items-center text-center mb-6">
                <div class="relative group">
                    <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 mb-4 ring-4 ring-blue-100">
                        @if(auth()->user()->photo)
                            <img src="{{ asset(auth()->user()->photo) }}" alt="{{ auth()->user()->firstname }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-500">
                                <i class="fas fa-user-circle text-5xl"></i>
                            </div>
                        @endif
                    </div>
                    <label for="photo-upload" class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full cursor-pointer shadow-md transition-all duration-300">
                        <i class="fas fa-camera"></i>
                        <input id="photo-upload" type="file" class="hidden" form="profile-form" name="photo" accept="image/*">
                    </label>
                </div>
                <h3 class="text-xl font-bold text-gray-800">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h3>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mt-1">
                    {{ auth()->user()->role->name ?? 'Administrator' }}
                </span>
            </div>

            <div class="border-t border-gray-200 pt-4 space-y-3">
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600 flex items-center">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i> Email
                    </span>
                    <span class="text-gray-900 font-medium">{{ auth()->user()->email }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600 flex items-center">
                        <i class="fas fa-shield-alt text-blue-500 mr-2"></i> Role
                    </span>
                    <span class="text-gray-900 font-medium">{{ auth()->user()->role->name ?? 'Administrator' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600 flex items-center">
                        <i class="fas fa-calendar-alt text-blue-500 mr-2"></i> Member Since
                    </span>
                    <span class="text-gray-900 font-medium">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600 flex items-center">
                        <i class="fas fa-clock text-blue-500 mr-2"></i> Last Login
                    </span>
                    <span class="text-gray-900 font-medium">{{ auth()->user()->last_login ?? 'Today' }}</span>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-200">
                <h4 class="font-medium text-gray-700 mb-3">Activity Summary</h4>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Products Added</span>
                        <span class="text-sm font-medium bg-blue-50 text-blue-700 px-2 py-1 rounded">{{ $stats['products_added'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Orders Processed</span>
                        <span class="text-sm font-medium bg-green-50 text-green-700 px-2 py-1 rounded">{{ $stats['orders_processed'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Users Managed</span>
                        <span class="text-sm font-medium bg-purple-50 text-purple-700 px-2 py-1 rounded">{{ $stats['users_managed'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="md:col-span-2">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
            <h3 class="text-xl font-bold text-blue-900 mb-6 flex items-center">
                <i class="fas fa-user-edit mr-2 text-blue-600"></i> Edit Profile
            </h3>

            <form id="profile-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="{{ old('firstname', auth()->user()->firstname) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('firstname') border-red-500 @enderror">
                        @error('firstname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('lastname') border-red-500 @enderror">
                        @error('lastname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg shadow-sm transition duration-300 flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-blue-900 mb-6 flex items-center">
                <i class="fas fa-lock mr-2 text-blue-600"></i> Change Password
            </h3>

            {{-- <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                @method('PUT') --}}

                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <div class="relative">
                        <input type="password" id="current_password" name="current_password"
                            class="w-full border rounded-lg pl-3 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-500 @enderror">
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full border rounded-lg pl-3 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full border border-gray-300 rounded-lg pl-3 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg shadow-sm transition duration-300 flex items-center">
                        <i class="fas fa-key mr-2"></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div id="successAlert" class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md max-w-md">
    <div class="flex items-center">
        <div class="py-1"><i class="fas fa-check-circle text-green-500 mr-3"></i></div>
        <div>
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
        <button onclick="document.getElementById('successAlert').remove()" class="ml-auto text-green-700 hover:text-green-900">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Photo preview
        const photoUpload = document.getElementById('photo-upload');
        const profileImage = document.querySelector('.w-32.h-32 img, .w-32.h-32 div');

        photoUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    if (profileImage.tagName === 'IMG') {
                        profileImage.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-full object-cover';
                        profileImage.parentNode.replaceChild(img, profileImage);
                    }
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        // Password visibility toggle
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Auto-hide success message after 5 seconds
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => successAlert.remove(), 500);
            }, 5000);
        }
    });
</script>
@endsection
