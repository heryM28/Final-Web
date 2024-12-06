
@extends('layouts.app')

@section('content')
    <section class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-blue-500 pb-2 mb-4">Tambah Pengguna Baru</h2>

        <!-- Formulir untuk Menambahkan Pengguna -->
        <form action="{{ route('admin.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nama Pengguna -->
                <div class="form-group">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Pengguna -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Password Pengguna -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konfirmasi Password Pengguna -->
                <div class="form-group">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Pilih Role -->
            <div class="form-group">
                <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
                <select name="role" id="role" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                </select>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- University Email (Optional) -->
            <div class="form-group">
                <label for="university_email" class="block text-sm font-semibold text-gray-700">Email Universitas (Opsional)</label>
                <input type="email" id="university_email" name="university_email" value="{{ old('university_email') }}" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('university_email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="form-group">
                <label for="is_active" class="inline-flex items-center text-sm font-semibold text-gray-700">
                    <input type="checkbox" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }} class="form-checkbox text-blue-500">
                    <span class="ml-2">Pengguna Aktif</span>
                </label>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors">
                    Tambah Pengguna
                </button>
            </div>
        </form>
    </section>
@endsection
