@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Edit Pengguna</h1>

    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full p-3 border border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-3 border border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <div class="relative">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    value="{{ old('password') }}"  
                    class="w-full p-3 border border-gray-300 rounded-lg"
                >
                <button 
                    type="button" 
                    id="togglePassword" 
                    class="absolute inset-y-0 right-0 px-3 text-gray-500" 
                >
                    👁️
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
            <select id="role" name="role" class="w-full p-3 border border-gray-300 rounded-lg" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                <option value="guest" {{ $user->role == 'guest' ? 'selected' : '' }}>Guest</option>  <!-- Tambahkan opsi guest -->
            </select>
        </div>

        <div class="mb-4">
            <label for="university_email" class="block text-sm font-semibold text-gray-700">Email Universitas</label>
            <input type="email" id="university_email" name="university_email" value="{{ old('university_email', $user->university_email) }}" class="w-full p-3 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="is_active" class="block text-sm font-semibold text-gray-700">Status Aktif</label>
            <input type="checkbox" id="is_active" name="is_active" {{ $user->is_active ? 'checked' : '' }} class="p-3">
        </div>

        <div class="text-center">
            <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg">Update Pengguna</button>
        </div>
    </form>
</div>

@endsection