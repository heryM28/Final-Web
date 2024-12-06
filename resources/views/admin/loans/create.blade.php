@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-bold text-gray-800 border-b-4 border-red-500 pb-2 mb-6">Tambah Peminjaman</h2>
    <form action="{{ route('admin.loans.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf

        <!-- Dropdown untuk Peminjam -->
        <div>
            <label for="user_id" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-user mr-2"></i>Peminjam
            </label>
            <select name="user_id" id="user_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-red-300">
                <option value="" disabled selected>Pilih Peminjam</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown untuk Buku -->
        <div>
            <label for="book_id" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-book mr-2"></i>Buku
            </label>
            <select name="book_id" id="book_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-red-300">
                <option value="" disabled selected>Pilih Buku</option>
                @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input Tanggal Pinjam -->
        <div>
            <label for="loan_date" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-calendar-alt mr-2"></i>Tanggal Pinjam
            </label>
            <input type="date" name="loan_date" id="loan_date" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-red-300">
        </div>

        <!-- Input Tanggal Kembali -->
        <div>
            <label for="due_date" class="block text-gray-700 font-medium mb-2">
                <i class="fas fa-calendar-check mr-2"></i>Tanggal Kembali
            </label>
            <input type="date" name="due_date" id="due_date" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-red-300">
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right">
            <button type="submit" 
                class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-200">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</section>
@endsection
