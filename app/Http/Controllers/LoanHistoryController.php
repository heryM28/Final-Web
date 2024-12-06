<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanHistoryController extends Controller
{
    public function history()
    {
        $user = Auth::user();

        // Ambil semua riwayat peminjaman berdasarkan pengguna yang login
        $loans = Loan::where('user_id', $user->id)->with('book')->get();

        return view('loans.history', compact('loans'));
    }
}
