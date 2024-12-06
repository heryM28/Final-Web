@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h1 class="text-xl font-bold text-gray-700 mb-6 text-center">Tambah Buku Baru</h1>

    <form action="{{ route('admin.book.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Judul Buku -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-600">Judul Buku</label>
                <input type="text" name="title" id="title" required
                    class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Penulis Buku -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-600">Penulis</label>
                <input type="text" name="author" id="author" required
                    class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Penerbit -->
            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-600">Penerbit</label>
                <input type="text" name="publisher" id="publisher" required
                    class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Tahun Terbit -->
            <div>
                <label for="publication_year" class="block text-sm font-medium text-gray-600">Tahun Terbit</label>
                <input type="number" name="publication_year" id="publication_year" min="1000" max="{{ date('Y') }}" required
                    class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
            </div>
        </div>

        <!-- Kategori -->
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-600">Kategori</label>
            <select name="category_id" id="category_id" required
                class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-600">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                placeholder="Opsional"></textarea>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Stok -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-600">Stok</label>
                <input type="number" name="stock" id="stock" required min="0"
                    class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Ketersediaan -->
            <div>
                <label for="is_available" class="block text-sm font-medium text-gray-600">Ketersediaan</label>
                <select name="is_available" id="is_available" required
                    class="w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                    <option value="1" selected>Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right">
            <button type="submit"
                class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
