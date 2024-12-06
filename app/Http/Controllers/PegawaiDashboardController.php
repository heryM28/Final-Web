<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class PegawaiDashboardController extends Controller
{
    public function index()

    {

         // Menghitung jumlah buku yang dipinjam
        $booksBorrowedCount = Loan::where('status', 'borrowed')->count();

        // Menghitung jumlah buku yang sudah dikembalikan
        $booksReturnedCount = Loan::where('status', 'returned')->count();
        // Mendapatkan data peminjaman dan buku yang perlu diproses
        $loans = Loan::where('status', 'pending')->paginate(7);
        $loans = Loan::paginate(7);
        $books = Book::paginate(7);

        // Pastikan untuk mengembalikan view yang sesuai
        return view('pegawai.dashboard', compact('loans', 'books', 'booksBorrowedCount', 'booksReturnedCount')); // Pastikan view ini ada
    }
}
