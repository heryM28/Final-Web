@extends('layouts.app')

@section('content')
<h1>Tambah Peminjaman Baru</h1>
<form action="{{ route('loan.store') }}" method="POST">
    @csrf
    <label for="book_id">Buku:</label>
    <select name="book_id" id="book_id" required>
        @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->title }}</option>
        @endforeach
    </select>
    <br>
    <label for="user_id">Peminjam:</label>
    <select name="user_id" id="user_id" required>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <br>
    <button type="submit">Simpan</button>
</form>
@endsection
