<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Menampilkan semua pengguna
        $users = User::paginate(10);
        return view('admin.index', compact('users')); 
    }

    public function create()
    {
        // Menampilkan halaman formulir untuk menambahkan pengguna baru
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,staff,student,guest',
            'university_email' => 'nullable|email',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'university_email' => $request->university_email,
            'is_active' => $request->has('is_active') ? true : false, // Default false jika tidak dicentang
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Menampilkan halaman formulir untuk mengedit pengguna
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Validasi email unik, kecuali milik user ini
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,staff,student,guest',
            'university_email' => 'nullable|email',
        ]);

        // Memperbarui data pengguna
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->university_email = $request->university_email;
        $user->is_active = $request->has('is_active') ? true : false;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus pengguna
        User::destroy($id);
        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function toggleActive($id)
    {
        // Mengaktifkan atau menonaktifkan pengguna
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status pengguna berhasil diperbarui.');
    }
}
