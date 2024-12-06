<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RenewLoanController extends Controller
{
    public function renewLoan($loanId)
    {
        $loan = Loan::findOrFail($loanId);

        // Perpanjang hanya jika buku belum dikembalikan
        if ($loan->return_date === null) {
            $loan->update([
                'due_date' => Carbon::now()->addDays(7),
            ]);

            return redirect()->route('loan.history')->with('success', 'Peminjaman berhasil diperpanjang.');
        }

        return redirect()->route('loan.history')->with('error', 'Buku sudah dikembalikan. Tidak dapat diperpanjang.');
    }
}
