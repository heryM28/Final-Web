<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::paginate(10);

        return view('admin.dashboard', compact('contacts'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Simpan data ke database
        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $contact = Contact::findOrFail($id);

        // Hapus data
        $contact->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Message deleted successfully!');
    }

}
