<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        $user = Auth::user();

        // Hitung jumlah buku yang dipinjam oleh pengguna yang sedang login
        $totalBukuDipinjam = Loan::where('status', 'borrowed')
            ->where('user_id', $user->id)  // Menambahkan filter berdasarkan user yang login
            ->count();

        // Hitung jumlah buku yang tersedia (jumlah total buku - jumlah buku yang dipinjam)
        $totalBukuTersedia = Book::count() - $totalBukuDipinjam;

        return view('home', compact('totalBukuDipinjam', 'totalBukuTersedia'));
    }
}
