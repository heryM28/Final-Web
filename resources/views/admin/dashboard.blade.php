@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <!-- Tombol Blue Mode -->
    <div class="mb-4">
        <button id="blue-mode-toggle" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out">
            Blue Mode
        </button>
    </div>

    <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Admin Dashboard</h1>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @php
            $stats = [
                ['title' => 'Total Pengguna', 'count' => $totalUsers, 'color' => 'blue-500'],
                ['title' => 'Total Buku', 'count' => $totalBooks, 'color' => 'green-500'],
                ['title' => 'Category Buku', 'count' => $totalCategories, 'color' => 'yellow-500'],
                ['title' => 'Total Peminjaman', 'count' => $totalLoans, 'color' => 'red-500'],
            ];
        @endphp

        @foreach ($stats as $stat)
        <div class="bg-blue-100 p-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ $stat['title'] }}</h2>
            <p class="text-4xl font-bold text-{{ $stat['color'] }}">{{ $stat['count'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Daftar Pengguna --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-blue-500 pb-2 mb-4">Daftar Pengguna</h2>
        <div class="mb-6 text-center">
            <a href="{{ route('admin.create') }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors">
                Tambah Pengguna
            </a>
        </div>
        <div class="bg-blue-100 shadow rounded-lg overflow-hidden">
            <table class="w-full table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Role</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr>
                        <td class="p-4">{{ $user->name }}</td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">{{ ucfirst($user->role) }}</td>
                        <td class="p-4 text-center">
                            <span class="px-4 py-1 {{ $user->is_active ? 'bg-green-500' : 'bg-red-500' }} text-white rounded">
                                {{ $user->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('admin.edit', $user->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded"
                                    onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Delete</button>
                            </form>
                            <form action="{{ route('admin.toggleActive', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 {{ $user->is_active ? 'bg-gray-500' : 'bg-blue-500' }} text-white rounded">
                                    {{ $user->is_active ? 'Non-Aktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="px-4 py-2">
                {{ $users->links() }}
            </div>
        </div>
    </section>

    <!-- Daftar Kategori -->
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-yellow-500 pb-2 mb-4">Daftar Kategori</h2>

        <!-- Tombol Tambah Kategori -->
        <div class="mb-4">
            <a href="{{ route('admin.category.create') }}"
            class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition duration-200 ease-in-out">
                Tambah Kategori
            </a>
        </div>

        <!-- Tabel Daftar Kategori -->
        <div class="bg-blue-100 shadow rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="p-4 text-left">Nama Kategori</th>
                        <th class="p-4 text-left">Deskripsi</th>
                        <th class="p-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categories as $category)
                    <tr>
                        <td class="p-4">{{ $category->name }}</td>
                        <td class="p-4">{{ $category->description }}</td>
                        <td class="p-4 flex space-x-2">
                            <!-- Edit Kategori -->
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                                Edit
                            </a>

                            <!-- Hapus Kategori -->
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
            <!-- Pagination -->
            <div class="px-4 py-2">
                {{ $categories->links() }}
            </div>
        </div>
    </section>

    <!-- Daftar Buku -->
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-green-500 pb-2 mb-4">Daftar Buku</h2>

        <!-- Tombol Tambah Buku -->
        <div class="mb-4">
            <a href="{{ route('admin.book.create') }}"
            class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-200 ease-in-out">
                Tambah Buku
            </a>
        </div>

        <!-- Tabel Daftar Buku -->
        <div class="bg-blue-100 shadow rounded-lg">
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
                    <tr>
                        <td class="p-4">{{ $book->title }}</td>
                        <td class="p-4">{{ $book->author }}</td>
                        <td class="p-4">{{ $book->publisher }}</td>
                        <td class="p-4">{{ $book->category->name ?? 'Tidak ada kategori' }}</td>
                        <td class="p-4">{{ $book->year }}</td>
                        <td class="p-4">{{ $book->stock }}</td>
                        <td class="p-4">{{ $book->description }}</td>
                        <td class="p-4 text-center">
                            <span class="px-4 py-1 {{ $book->is_available ? 'bg-green-500' : 'bg-red-500' }} text-white rounded">
                                {{ $book->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('admin.book.edit', $book->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('admin.book.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="px-4 py-2">
                {{ $books->links() }}
            </div>
        </div>
    </section>
</div>

<!-- Script untuk Toggle Blue Mode -->
<script>
    document.getElementById('blue-mode-toggle').addEventListener('click', function() {
        document.body.classList.toggle('blue-mode');
        if (document.body.classList.contains('blue-mode')) {
            localStorage.setItem('blueMode', 'enabled');
        } else {
            localStorage.removeItem('blueMode');
        }
    });

    // Cek Blue Mode saat halaman dimuat
    if (localStorage.getItem('blueMode') === 'enabled') {
        document.body.classList.add('blue-mode');
    }
</script>

@endsection

<style>
    body.blue-mode {
        background-color: #1e3a8a; /* Biru gelap */
        color: white;
    }

    body.blue-mode .container {
        background-color: #3b82f6; /* Biru terang */
    }

    body.blue-mode .bg-blue-100 {
        background-color: #60a5fa; /* Biru muda */
    }

    body.blue-mode .bg-blue-500 {
        background-color: #2563eb; /* Biru lebih gelap */
    }

    body.blue-mode .text-blue-600 {
        color: #1e40af; /* Biru lebih gelap */
    }

    body.blue-mode .text-blue-500 {
        color: #3b82f6;
    }
</style>
