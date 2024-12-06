<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiDashboardController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use App\Http\Controllers\NewsletterController;

// Halaman Utama (Home)
Route::get('/', function () {
    $books = Book::all();  // Mengambil data buku dari model
    return view('welcome', compact('books'));  // Menyertakan data buku ke dalam view welcome.blade.php
})->name('home');

// Rute untuk Authentication (Guest Middleware)
Route::middleware('guest')->group(function () {
    // Form Register
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    // Form Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

// Rute Logout (Auth Middleware)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Rute Halaman Statis (Features, About, Contact)
Route::get('/features', fn() => view('features.features'))->name('features');

Route::get('/about', fn() => view('about.about'))->name('about');

// Rute untuk Contact Us
Route::get('/contact-us', function () {
    return view('contact.contact'); // Sesuaikan dengan nama file blade Anda
})->name('contact-us');
// Rute untuk Halaman Kontak
Route::get('/contact', function () {
    return view('contact.contact'); // Sesuaikan nama file view jika berbeda
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

// Rute untuk halaman volunteer
Route::get('/volunteer', function () {
    return view('volunter.volunteer');  // Halaman untuk pendaftaran sukarelawan
})->name('volunteer');

// Rute untuk pengiriman formulir sukarelawan
Route::post('/submit-volunteer', function (Request $request) {
    // Proses pengiriman data (misalnya, menyimpannya di database atau mengirim email)
    return redirect('/volunteer')->with('status', 'Thank you for volunteering! Your application has been submitted.');
})->name('submit-volunteer');

Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Rute untuk Privacy Policy
Route::get('/privacy-policy', fn() => view('privacy-policy'))->name('privacy-policy');

// Rute untuk Terms of Service
Route::get('/terms-of-service', fn() => view('terms-of-service'))->name('terms-of-service');

// Rute untuk FAQ
Route::get('/faq', fn() => view('faq'))->name('faq');

// Tambahkan route pencarian buku di sini
Route::get('/search', [BookController::class, 'search'])->name('search');

// Rute untuk User dan Admin (Auth & Verified Middleware)
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/create', [AdminDashboardController::class, 'create'])->name('admin.create');
    Route::post('admin/store', [AdminDashboardController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminDashboardController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/{id}', [AdminDashboardController::class, 'update'])->name('admin.update');
    Route::post('admin/{id}/toggle-active', [AdminDashboardController::class, 'toggleActive'])->name('admin.toggleActive');
    Route::delete('/admin/{id}/delete', [AdminDashboardController::class, 'destroy'])->name('admin.destroy');

    //book management
    Route::get('/admin/book/create', [BookController::class, 'create'])->name('admin.book.create');
    Route::post('/admin/book/store', [BookController::class, 'store'])->name('admin.book.store');
    Route::get('/admin/book/{id}/edit', [BookController::class, 'edit'])->name('admin.book.edit');
    Route::post('/admin/book/{id}', [BookController::class, 'update'])->name('admin.book.update');
    Route::delete('/admin/book/{id}/delete', [BookController::class, 'destroy'])->name('admin.book.destroy');
    Route::get('/books/search-results', [BookController::class, 'search'])->name('books.searh-results');
    Route::get('admin/book/{book}', [BookController::class, 'show'])->name('admin.book.show');

    //category mangement
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    //peminjam
    Route::get('/admin/loans/index', [LoanController::class, 'index'])->name('admin.loans.index');
    Route::get('/admin/loans/create', [LoanController::class, 'create'])->name('admin.loans.create');
    Route::post('/admin/loans/store', [LoanController::class, 'store'])->name('admin.loans.store');
    Route::get('/admin/loans/{id}/edit', [LoanController::class, 'edit'])->name('admin.loans.edit');
    Route::post('/admin/loans/{id}', [LoanController::class, 'update'])->name('admin.loans.update');
    Route::delete('/admin/loans/{id}/delete', [LoanController::class, 'destroy'])->name('admin.loans.destroy');
    Route::patch('/admin/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('admin.loans.return');

    // Rute dashboard pegawai
    Route::get('/pegawai/dashboard', [PegawaiDashboardController::class, 'index'])->name('pegawai.dashboard');

    // Rute dashboard mahasiswa
    Route::get('/student/dashboard', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');
    Route::post('/student/borrow', [MahasiswaDashboardController::class, 'borrow'])->name('mahasiswa.borrow');
    Route::patch('/student/return/{loan}', [MahasiswaDashboardController::class, 'returnBook'])->name('mahasiswa.return');


    // Rute /dashboard akan diarahkan ke admin atau pegawai dashboard
    Route::get('/dashboard', function () {
        // Cek peran pengguna dan arahkan ke dashboard yang sesuai
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('pegawai.dashboard');
    })->name('dashboard');

    // Rute untuk katalog buku
    Route::get('/books/book-catalog', [BookController::class, 'bookCatalog'])->name('books.book-catalog');

    // // Rute untuk Buku (CRUD kecuali destroy)
    // Route::resource('books', BookController::class)->except(['destroy']);
    // Rute untuk Peminjaman (Loans)
    // Route::resource('loans', LoanController::class);

    // Rute untuk Profil Pengguna
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    // Rute untuk Notifikasi
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});

// Rute untuk Controller Auth lainnya (kecuali RegisteredUserController, HomeController, LoginController)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Konfirmasi Password
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])->name('password.confirm');

    // Notifikasi Verifikasi Email
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->name('verification.send');

    // Prompt Verifikasi Email
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    // Verifikasi Email
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed'])->name('verification.verify');

    // Reset Password
    Route::post('/password/reset-link', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('/password/reset', [NewPasswordController::class, 'store'])->name('password.update');

    // Update Password
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');
});

// Rute Home menggunakan HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home');
