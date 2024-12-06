@extends('layouts.app')

@section('content')
<h1>Daftar Peminjaman</h1>
<ul>
    @foreach ($loans as $loan)
        <li>
            Buku: {{ $loan->book->title }} -
            Peminjam: {{ $loan->user->name }} -
            Status: {{ $loan->status }}
        </li>
    @endforeach
</ul>
@endsection
