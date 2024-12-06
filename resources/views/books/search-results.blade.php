@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container py-6">
    <!-- Header Hasil Pencarian -->
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Hasil Pencarian untuk "{{ $query }}"</h1>
        <!-- Tombol Kembali -->
        <button onclick="history.back()"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Kembali
        </button>
    </div>

    @if($results->isEmpty())
        <p class="text-gray-600">Tidak ada buku yang ditemukan.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($results as $book)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <a href="{{ route('admin.book.show', $book->id) }}" class="block mb-4">
                        <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/200x150' }}"
                             alt="{{ $book->title }}"
                             class="w-full h-48 object-cover rounded-md">
                        <h3 class="text-lg font-semibold hover:underline">{{ $book->title }}</h3>
                    </a>
                    <p class="text-gray-600">Penulis: {{ $book->author }}</p>
                    <p class="text-gray-600">Tahun Terbit: {{ $book->publication_year }}</p>
                    <p class="text-gray-600">Stok: {{ $book->stock }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
