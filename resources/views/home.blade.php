@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="container mx-auto py-12 px-6">
        <!-- Judul Halaman -->
        <h1 class="text-4xl font-extrabold text-center text-green-700 mb-10">
            Selamat Datang di Platform Peminjaman Buku Digital Kami
        </h1>

        <!-- Deskripsi -->
        <div class="text-center mb-10">
            <p class="text-lg text-gray-700 mb-4">
                Kami hadir untuk memberikan kemudahan dalam mengakses koleksi buku digital terbaik. Nikmati pengalaman membaca yang menyenangkan dan mudah!
            </p>
            <p class="text-lg text-gray-600">
                Temukan berbagai buku menarik dan jadilah bagian dari komunitas pembaca kami.
            </p>
        </div>

        <!-- Statistik Hari Ini -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
            <div class="bg-green-100 p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-lg font-medium text-green-800 mb-2">Jumlah Buku Dipinjam</h3>
                <p class="text-2xl font-bold text-green-900">{{ $totalBukuDipinjam }}</p>
            </div>
            <div class="bg-blue-100 p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-lg font-medium text-blue-800 mb-2">Jumlah Buku Tersedia</h3>
                <p class="text-2xl font-bold text-blue-900">{{ $totalBukuTersedia }}</p>
            </div>
        </div>

        <!-- Pesan Selamat Datang Dinamis -->
        @auth
            <div class="bg-gray-100 p-6 rounded-lg shadow-lg mb-12">
                <h1 class="text-3xl font-bold text-center text-green-600">
                    Halo, {{ Auth::user()->name }}! Selamat Datang Kembali.
                </h1>
            </div>
        @endauth

        <!-- Form Pencarian Buku -->
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Temukan Buku Favorit Anda</h2>
            @if ($errors->any())
                <div class="mb-4 text-red-500 text-center">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            <form action="{{ route('search') }}" method="GET" class="flex flex-col gap-4">
                <input
                    type="text"
                    name="query"
                    placeholder="Cari buku berdasarkan judul, penulis, atau kategori"
                    aria-label="Masukkan kata kunci pencarian"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Cari Buku
                </button>
            </form>
        </div>

        <!-- Aksesibilitas -->
        <div class="text-center mt-16">
            <i class="fas fa-book text-blue-500 text-5xl mb-4"></i>
            <p class="text-lg font-medium text-gray-700">
                Menyediakan koleksi buku digital terbaik untuk Anda
            </p>
        </div>

        <!-- Bagian Footer -->
        <footer class="mt-16 py-6 bg-gray-800 text-center text-gray-400 rounded-lg">
            <p class="text-sm">© 2024 Sistem Peminjaman Buku Digital. Semua hak cipta dilindungi.</p>
        </footer>
    </div>
@endsection
