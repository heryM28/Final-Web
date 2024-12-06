@extends('layouts.app')

@section('title', 'Pegawai Dashboard')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-green-600 mb-6 text-center">Pegawai Dashboard</h1>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 shadow rounded-lg text-center">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Buku Tersedia</h2>
            <p class="text-4xl font-bold text-blue-500">{{ $books->count() }}</p>
        </div>

        <div class="bg-white p-6 shadow rounded-lg text-center">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Peminjaman</h2>
            <p class="text-4xl font-bold text-red-500">{{ $loans->count() }}</p>
        </div>

        {{-- Buku Dipinjam --}}
        <div class="bg-white p-6 shadow rounded-lg text-center">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Buku Dipinjam</h2>
            <p class="text-4xl font-bold text-yellow-500">{{ $booksBorrowedCount }}</p>
        </div>

        {{-- Buku Dikembalikan --}}
        <div class="bg-white p-6 shadow rounded-lg text-center">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Buku Dikembalikan</h2>
            <p class="text-4xl font-bold text-green-500">{{ $booksReturnedCount }}</p>
        </div>
    </div>

    {{-- Daftar Tugas --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-green-500 pb-2 mb-4">Daftar Tugas</h2>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @foreach ($loans as $loan)
                <li class="p-4 flex justify-between items-center hover:bg-gray-50 transition duration-300">
                    <div>
                        <span class="font-semibold">{{ $loan->book->title }}</span>
                        <p class="text-gray-600">{{ $loan->book->author }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-white
                        {{ $loan->status == 'dikembalikan' ? 'bg-green-500' : 'bg-yellow-500' }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Daftar Buku yang Dikelola --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-blue-500 pb-2 mb-4">Buku yang Harus Dikelola</h2>
        <div class="bg-white shadow rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-4 text-left">Judul Buku</th>
                        <th class="p-4 text-left">Penulis</th>
                        <th class="p-4 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($books as $book)
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="p-4">{{ $book->title }}</td>
                        <td class="p-4">{{ $book->author }}</td>
                        <td class="p-4">
                            <span class="{{ $book->is_available ? 'bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm' : 'bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm' }}">
                                {{ $book->is_available ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Pagination -->
    <section class="mb-8">
        <div class="flex justify-center">
            {{ $books->links('pagination::tailwind') }}  <!-- Gunakan pagination tailwind -->
        </div>
    </section>

     <!-- Daftar Buku -->
     <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-green-500 pb-2 mb-4">Daftar Buku</h2>

        <!-- Tombol Tambah Buku -->
        <div class="mb-4 text-center">
            <a href="{{ route('admin.book.create') }}" 
            class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200 ease-in-out">
                Tambah Buku
            </a>
        </div>

        <!-- Tabel Daftar Buku -->
        <div class="bg-white shadow rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="p-4 text-left">Judul Buku</th>
                        <th class="p-4 text-left">Penulis</th>
                        <th class="p-4 text-left">Penerbit</th>
                        <th class="p-4 text-left">Kategori</th>
                        <th class="p-4 text-left">Tahun Terbit</th>
                        <th class="p-4 text-left">Stok</th>
                        <th class="p-4 text-left">Deskripsi</th>
                        <th class="p-4 text-left">Tersedia</th>
                        <th class="p-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($books as $book)
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="p-4">{{ $book->title }}</td>
                        <td class="p-4">{{ $book->author }}</td>
                        <td class="p-4">{{ $book->publisher }}</td>
                        <td class="p-4">{{ $book->category->name ?? 'Tidak ada kategori' }}</td>
                        <td class="p-4">{{ $book->publication_year }}</td>
                        <td class="p-4">{{ $book->stock }}</td>
                        <td class="p-4">{{ $book->description ?? '-' }}</td>
                        <td class="p-4">
                            <span class="{{ $book->is_available ? 'bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm' : 'bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm' }}">
                                {{ $book->is_available ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="p-4 flex space-x-2 justify-center">
                            <!-- Edit Buku -->
                            <a href="{{ route('admin.book.edit', $book->id) }}" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                                Edit
                            </a>
                            
                            <!-- Hapus Buku -->
                            <form action="{{ route('admin.book.destroy', $book->id) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200 ease-in-out">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Pagination -->
    <section class="mb-8">
        <div class="flex justify-center">
            {{ $books->links('pagination::tailwind') }}  <!-- Gunakan pagination tailwind -->
        </div>
    </section>
</div>
@endsection
