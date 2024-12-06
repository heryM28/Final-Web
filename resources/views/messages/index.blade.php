@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Daftar Pesan</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Pesan</th>
                    <th class="px-6 py-3">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $message->name }}</td>
                        <td class="px-6 py-4">{{ $message->email }}</td>
                        <td class="px-6 py-4">{{ $message->message }}</td>
                        <td class="px-6 py-4">{{ $message->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
