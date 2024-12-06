@extends('layouts.app')

@section('content')
<h1>Daftar Notifikasi</h1>
<ul>
    @foreach ($notifications as $notification)
        <li>{{ $notification->message }} - {{ $notification->created_at->diffForHumans() }}</li>
    @endforeach
</ul>
@endsection
