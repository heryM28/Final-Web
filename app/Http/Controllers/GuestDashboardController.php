<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestDashboardController extends Controller
{
    /**
     * Display the dashboard for guests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data tambahan untuk dashboard bisa disiapkan di sini.
        return view('guest.dashboard', [
            'welcomeMessage' => 'Welcome to the Library System!',
        ]);
    }
}
