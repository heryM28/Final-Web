@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Profil Pengguna</h1>
        
        <div class="mb-4">
            <p class="text-lg font-medium text-gray-700">Nama:</p>
            <p class="text-lg text-gray-600">{{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <p class="text-lg font-medium text-gray-700">Email:</p>
            <p class="text-lg text-gray-600">{{ $user->email }}</p>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('profile.edit') }}" 
               class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200 ease-in-out">
               Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
