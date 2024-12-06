<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Carbon\Carbon;

class MahasiswaDashboardController extends Controller
{
    // public function index()
    // {
    //     // Mendapatkan riwayat peminjaman dan buku yang sedang dipinjam oleh mahasiswa yang login
    //     $loans = Loan::where('user_id', Auth::id())->get();

    //     return view('mahasiswa.dashboard', compact('loans'));
    // }

    public function index()
    {
        $loans = Loan::with('book')->where('user_id', Auth::id())->get();
        $books = Book::whereDoesntHave('loans', function ($query) {
            $query->where('status', 'borrowed');
        })->get();

        return view('mahasiswa.dashboard', compact('loans', 'books'));
    }

    public function borrow(Request $request)
    {
         // Validasi peminjaman
         $request->validate([
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
        ]);

        // Menyimpan peminjaman
        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Buku berhasil dipinjam!');
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->user_id != Auth::id() || $loan->status != 'borrowed') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Pengembalian tidak valid.');
        }

        $dueDate = Carbon::parse($loan->due_date);
        $lateDays = $dueDate->isPast() ? $dueDate->diffInDays(Carbon::now()) : 0;
        $fineAmount = $lateDays > 0 ? $lateDays * 1000 : 0;

        $loan->update(['status' => 'returned']);

        $message = $fineAmount > 0 
            ? "Buku berhasil dikembalikan dengan denda Rp {$fineAmount}" 
            : "Buku berhasil dikembalikan tanpa denda.";
        
        return redirect()->route('mahasiswa.dashboard')->with('success', $message);
    }


}
