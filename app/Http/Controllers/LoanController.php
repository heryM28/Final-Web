<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use App\Models\Fine;
use Carbon\Carbon; // pastikan ini ada untuk manipulasi tanggal
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoanController extends Controller
{

    public function index ()
    {

        $loans = Loan::with('book', 'user', 'fines')->paginate(10);
        return view('admin.loans.index', compact('loans'));

    }

    public function create()
    {
        $books = Book::all();
        $users = User::all();

        return view('admin.loans.create', compact('books', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
        ]);

        Loan::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        return redirect()->route('admin.loans.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    // Menampilkan form edit data peminjaman
    public function edit($id)
    {
        $books = Book::all();
        $users = User::all();
        $loan = Loan::findOrFail($id);
        return view('admin.loans.edit', compact('loan','books', 'users'));
    }

    // Memperbarui data peminjaman
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'status' => 'required|in:borrowed,returned,extended',
        ]);

        // Cari data peminjaman berdasarkan ID
        $loan = Loan::findOrFail($id); // Loan di sini adalah model Eloquent

        // Update data
        $loan->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('admin.loans.index')->with('success', 'Peminjaman berhasil diperbarui!');
    }


    // Menghapus data peminjaman
    public function destroy(Loan $id)
    {
        $id->delete();
        return redirect()->route('admin.loans.index')->with('success', 'Peminjaman berhasil dihapus!');
    }


    public function returnBook(Loan $loan)
    {
        // Pastikan status peminjaman valid untuk dikembalikan
        if ($loan->status === 'returned') {
            return redirect()->route('admin.loans.index')->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }
    
        // Periksa jika tanggal jatuh tempo valid
        $dueDate = Carbon::parse($loan->due_date);
    
        if (!$dueDate || $dueDate->greaterThan(Carbon::now())) {
            return redirect()->route('admin.loans.index')->with('error', 'Peminjaman belum melewati tanggal jatuh tempo.');
        }
    
        // Hitung jumlah hari keterlambatan
        $lateDays = Carbon::now()->diffInDays($dueDate, true); // Menggunakan "false" untuk hasil negatif jika belum jatuh tempo
    
        // Hitung denda jika ada keterlambatan
        $fineAmount = $lateDays > 0 ? $lateDays * 1000 : 0; // Rp 1000 per hari keterlambatan
    
        // Log informasi terkait keterlambatan dan denda
        Log::info("Pengembalian Buku: Loan ID {$loan->id}, Hari Keterlambatan: {$lateDays}, Denda: Rp {$fineAmount}");
    
        // Jika ada denda, buat data denda
        if ($fineAmount > 0) {
            Fine::create([
                'loan_id' => $loan->id,
                'amount' => $fineAmount,
                'user_id' => $loan->user_id,
            ]);
        }
    
        // Update status peminjaman menjadi "dikembalikan" 
        $loan->update(['status' => 'returned']);
    
        // Tambahkan flash message berdasarkan denda
        if ($fineAmount > 0) {
            return redirect()->route('admin.loans.index')->with('success', "Buku berhasil dikembalikan dengan denda: Rp {$fineAmount}");
        }
    
        return redirect()->route('admin.loans.index')->with('success', 'Buku berhasil dikembalikan tanpa denda!');
    }


}
