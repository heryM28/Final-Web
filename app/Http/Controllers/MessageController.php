<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        // Ambil semua pesan dari database
        $messages = Message::latest()->get();
        return view('messages.index', compact('messages'));
    }
}
