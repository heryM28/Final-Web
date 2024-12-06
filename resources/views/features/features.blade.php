@extends('layouts.app')

@section('title', 'Features')

@section('content')
<div class="container mx-auto py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">Fitur Sistem Perpustakaan</h1>
        <p class="text-xl text-gray-600 mt-2">Berikut adalah beberapa fitur yang tersedia di sistem manajemen perpustakaan digital kami.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <!-- Fitur 1: Manajemen Buku -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 3h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">Manajemen Buku</h2>
            <p class="text-gray-600 mt-2">Mengelola koleksi buku dengan mudah, termasuk menambah, mengedit, dan menghapus buku.</p>
        </div>

        <!-- Fitur 2: Peminjaman Buku -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9V5a2 2 0 012-2h0a2 2 0 012 2v4M15 13h6M9 13H3m6 4h6m-6 4h6" />
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">Peminjaman Buku</h2>
            <p class="text-gray-600 mt-2">Memungkinkan pengguna untuk meminjam buku yang tersedia di perpustakaan.</p>
        </div>

        <!-- Fitur 3: Notifikasi -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4M12 16h0M7.12 4.88a4 4 0 010 5.66m9.76-5.66a4 4 0 010 5.66M4 12h16m-7.02 5.35A3 3 0 0112 18a3 3 0 01-2.94-2.65A7.99 7.99 0 005 12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.47-.42 2.84-1.14 4.02a3 3 0 01-2.94 2.65" />
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">Notifikasi</h2>
            <p class="text-gray-600 mt-2">Memberikan pemberitahuan tentang buku yang terlambat dikembalikan atau pembaruan terkait peminjaman.</p>
        </div>

        <!-- Fitur 4: Akses Pengguna -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2a6 6 0 00-6 6v3a2 2 0 01-2 2h-3a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2v-4a2 2 0 00-2-2h-3a2 2 0 01-2-2V8a6 6 0 00-6-6z" />
                </svg>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">Akses Pengguna</h2>
            <p class="text-gray-600 mt-2">Terdapat akses berbeda untuk Admin, Pegawai, dan Mahasiswa dengan hak akses yang disesuaikan.</p>
        </div>
    </div>
</div>
@endsection
