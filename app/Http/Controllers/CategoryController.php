<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Menampilkan halaman formulir untuk mengedit pengguna
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        // Cari kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Update data kategori
        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        // Redirect kembali ke daftar kategori dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Hapus kategori
        $category->delete();

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil dihapus!');
    }



}
