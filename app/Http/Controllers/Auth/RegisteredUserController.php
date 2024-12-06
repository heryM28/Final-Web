<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,staff,student,guest'], // Validasi role
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'], // Role sesuai input form
            'password' => Hash::make($validated['password']),
        ]);

        // Menyebarkan event Registered untuk setelah pengguna terdaftar 
        event(new Registered($user));

        // Masuk otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route(match ($user->role) {
            'admin' => 'admin.dashboard',
            'staff' => 'pegawai.dashboard',
            'student' => 'mahasiswa.dashboard',
            default => 'guest.dashboard',
        });

    }
}
