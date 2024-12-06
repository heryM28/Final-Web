@extends('layouts.app')

@section('title', 'Mahasiswa Dashboard')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-green-600 mb-6 text-center">Mahasiswa Dashboard</h1>

    {{-- Tampilkan Pesan Error --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tampilkan Pesan Sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Meminjam Buku --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-green-500 pb-2 mb-4">Meminjam Buku</h2>
        <form action="{{ route('mahasiswa.borrow') }}" method="POST" class="space-y-6">
            @csrf
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <select name="book_id" class="border rounded-lg p-2 w-full sm:w-1/2" required>
                    <option value="">Pilih Buku</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }} - {{ $book->author }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-4">
                <div class="w-full sm:w-1/2">
                    <label for="loan_date" class="block text-gray-700">Tanggal Peminjaman</label>
                    <input type="date" name="loan_date" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="w-full sm:w-1/2">
                    <label for="due_date" class="block text-gray-700">Tanggal Pengembalian</label>
                    <input type="date" name="due_date" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
            </div>
            <button type="submit" class="w-full sm:w-auto bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-200">Pinjam Buku</button>
        </form>
    </section>

    {{-- Riwayat Peminjaman --}}
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-green-500 pb-2 mb-4">Riwayat Peminjaman</h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Judul Buku</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($loans as $loan)
                    <tr>
                        <td class="px-6 py-4 text-gray-800">{{ $loan->book->title }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-white {{ $loan->status == 'returned' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($loan->status == 'borrowed')
                            <form action="{{ route('mahasiswa.return', $loan->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">Kembalikan</button>
                            </form>
                            @else
                            <span class="text-gray-500">Tidak ada aksi</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
