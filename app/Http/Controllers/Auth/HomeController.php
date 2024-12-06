<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Book; // Pastikan model Book sudah ada
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        // Mengambil semua data buku dari database
        $books = Book::all();

        // Mengirim data buku ke view 'welcome'
        return view('welcome', compact('books'));
    }
}
