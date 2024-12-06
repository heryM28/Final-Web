<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReturnBookController extends Controller
{
    public function returnBook($loanId)
    {
        $loan = Loan::findOrFail($loanId);

        // Pastikan buku belum dikembalikan
        if ($loan->return_date === null) {
            $loan->update([
                'return_date' => Carbon::now(),
            ]);

            return redirect()->route('loan.history')->with('success', 'Buku berhasil dikembalikan.');
        }

        return redirect()->route('loan.history')->with('error', 'Buku sudah dikembalikan.');
    }
}
