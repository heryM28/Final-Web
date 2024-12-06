@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $book->title }}</h1>
        <p class="text-gray-600 mb-2"><strong>Penulis:</strong> {{ $book->author }}</p>
        <p class="text-gray-600 mb-6"><strong>Deskripsi:</strong> {{ $book->description }}</p>
        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Kembali ke Daftar Buku
            </a>
        </div>
    </div>
</div>
@endsection
