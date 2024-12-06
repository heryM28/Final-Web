<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data laporan
        // Misalnya, mengambil data laporan dari database
        return view('reports.index'); // Pastikan view reports.index ada
    }
}
