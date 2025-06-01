@extends('admindashboard.layout')

@section('title', 'Create Product')
@section('page_title', 'Create New Product')

@section('extra_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-900">Add New Product</h2>
        <a href="{{ route('produits') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i> Back to Products
        </a>
    </div>

    <form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('POST')
        @php
            // Ensure $categories is always defined for the view
            if (!isset($categories)) {
                $categories = \App\Models\Categorie::all();
            }
        @endphp

        <!-- Basic Information -->
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" id="prix" name="prix" value="{{ old('prix') }}" step="0.01" min="0" required
                            class="w-full border rounded-lg pl-7 pr-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('prix') border-red-500 @enderror">
                    </div>
                    @error('prix')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categorie -->
                <div>
                    <label for="Categorie_id" class="block text-sm font-medium text-gray-700 mb-1">Categorie <span class="text-red-500">*</span></label>
                    <select id="Categorie_id" name="Categorie_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('Categorie_id') border-red-500 @enderror">
                        <option value="">Select categorie</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity <span class="text-red-500">*</span></label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-4">Product Details</h3>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Product Image -->
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Product Image <span class="text-red-500">*</span></label>
                <div class="mt-1 flex items-center">
                    <div class="w-full">
                        <label class="block w-full px-4 py-2 bg-white border rounded-lg cursor-pointer hover:bg-gray-50 focus:outline-none">
                            <span class="text-sm text-gray-600">Choose file...</span>
                            <input id="photo" name="photo" type="file" class="hidden" accept="image/*" required>
                        </label>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div id="image-preview" class="mt-3 hidden">
                    <img src="" alt="Image Preview" class="h-32 w-32 object-cover rounded-lg border">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg shadow-sm transition duration-300">
                <i class="fas fa-save mr-2"></i> Create Product
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Select2
        $('#categorie_id').select2({
            placeholder: 'Select a categorie',
            allowClear: true
        });

        // Image preview
        const photoInput = document.getElementById('photo');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = imagePreview.querySelector('img');

        photoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection
