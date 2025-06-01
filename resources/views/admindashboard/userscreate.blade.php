@extends('admindashboard.layout')

@section('title', 'Create User')
@section('page_title', 'Create New User')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-900">Add New User</h2>
        <a href="{{ route('indexusers') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i> Back to Users
        </a>
    </div>

    <form action="{{ route('storeusers') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- User Information -->
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">User Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- First Name -->
                <div>
                    <label for="firstname" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('firstname') border-red-500 @enderror">
                    @error('firstname')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('lastname') border-red-500 @enderror">
                    @error('lastname')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                    <select id="role_id" name="role_id" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('role_id') border-red-500 @enderror">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Password Section -->
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Password</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Profile Photo -->
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Profile Photo</h3>
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Upload Photo</label>
                <label class="block w-full mt-1 px-4 py-2 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 focus:outline-none">
                    <span id="file-name" class="text-sm text-gray-600">Choose file...</span>
                    <input id="photo" name="photo" type="file" class="hidden" accept="image/*">
                </label>
                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                @error('photo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

                <div id="image-preview" class="mt-3 hidden">
                    <img src="" alt="Image Preview" class="h-24 w-24 object-cover rounded-full border border-gray-300">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg shadow-sm transition duration-300">
                <i class="fas fa-user-plus mr-2"></i> Create User
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('photo');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = imagePreview.querySelector('img');
        const fileName = document.getElementById('file-name');

        photoInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;

                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection
