<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendReturnReminder(Loan $loan)
    {
        if ($loan->due_date->isTomorrow()) {
            Notification::create([
                'user_id' => $loan->user_id,
                'message' => "Pengembalian buku '{$loan->book->title}' akan jatuh tempo besok.",
            ]);
        }
    }
}
