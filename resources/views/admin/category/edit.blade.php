@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Edit Kategori</h1>

    {{-- Form Edit Kategori --}}
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama Kategori</label>
            <input type="text" id="name" name="name" 
                value="{{ $category->name }}" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
            <textarea id="description" name="description" rows="4" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>{{ $category->description }}</textarea>
        </div>

        {{-- Tombol Simpan --}}
        <div class="text-center">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Tombol Kembali --}}
    <div class="text-center mt-4">
        <a href="{{ route('admin.dashboard') }}" 
            class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors">
            Kembali
        </a>
    </div>
</div>
@endsection
