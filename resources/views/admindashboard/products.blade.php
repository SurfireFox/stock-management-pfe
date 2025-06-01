@extends('admindashboard.layout')

@section('title', 'Produits Management')
@section('page_title', 'Produits Management')

@section('extra_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Liste des Produits</h2>
        <div class="flex space-x-2">
            <button id="exportPdf" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </button>
            <a href="{{ route('createproduit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Ajouter Produit
            </a>
        </div>
    </div>

    <!-- Filters (Static for now) -->
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <h3 class="text-lg font-medium text-gray-700 mb-3">Filters</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categorie</label>
                <select class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">All Categories</option>
                    <!-- Dynamically load categories if needed -->
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                <div class="flex space-x-2">
                    <input type="number" placeholder="Min" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <input type="number" placeholder="Max" class="w-full border border-gray-300 rounded-md px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock Status</label>
                <select class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">All</option>
                    <option value="in_stock">In Stock</option>
                    <option value="low_stock">Low Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-full">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- produits Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categorie</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($produit as $produit)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $produit->id }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ $produit->photo }}" alt="{{ $produit->name }}" class="h-10 w-10 rounded-md object-cover">
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $produit->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $produit->categorie->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $produit->prix }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $produit->stock ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full
                            {{ $produit->stock == 0 ? 'bg-red-100 text-red-800' : ($produit->stock < 10 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                            {{ $produit->stock == 0 ? 'Out of Stock' : ($produit->stock < 10 ? 'Low Stock' : 'In Stock') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <a href="{{ route('produit.update', $produit->id) }}" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('produit.delete', $produit->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">No produits found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination (if using paginate() in controller) -->
    <div class="mt-6">
        {{-- {{ $produits->links() }} --}}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('select').select2();
        document.getElementById('exportPdf').addEventListener('click', function () {
            alert('PDF export functionality will be implemented here');
        });
    });
</script>
@endsection
