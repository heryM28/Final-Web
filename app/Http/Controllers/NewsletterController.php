<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validasi input email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan email ke database
        DB::table('subscribers')->insert([
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
