<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // public function index()
    // {
    //     $books = Book::all(); // Mengambil semua buku dari database
    //     return view('admin.dashboard', compact('books')); // Pastikan file 'books.index' ada
    // }
    public function create()
    {
        $categories = Category::all();
        return view('admin.book.create', compact('categories')); // Pastikan file 'books.create' ada
    }

    public function store(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|numeric|min:1000|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'required|boolean',
        ]);

        // Membuat objek Book baru
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->publication_year = $request->input('publication_year');
        $book->stock = $request->input('stock');
        $book->description = $request->input('description');
        $book->category_id = $request->input('category_id');
        $book->is_available = $request->input('is_available');

        // Menyimpan data buku ke database
        $book->save();

        // Mengarahkan kembali ke halaman daftar buku dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $book = Book::findOrFail($id);
        return view('admin.book.edit', compact('book', 'categories')); // Pastikan file 'books.edit' ada
    }

    public function update(Request $request, $id)
    {
        // Validasi input pengguna
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|numeric|min:1000|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'required|boolean',
        ]);
    
        // Mencari buku berdasarkan ID
        $book = Book::findOrFail($id);
    
        // Memperbarui data buku
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->publication_year = $request->input('publication_year');
        $book->stock = $request->input('stock');
        $book->description = $request->input('description');
        $book->category_id = $request->input('category_id');
        $book->is_available = $request->input('is_available');
    
        // Menyimpan perubahan ke database
        $book->save();
    
        // Mengarahkan kembali ke halaman daftar buku dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Buku berhasil diperbarui.');
    }
    

    public function destroy($id)
    {
        // Mencari buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Menghapus buku dari database
        $book->delete();

        // Mengarahkan kembali ke halaman daftar buku dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Buku berhasil dihapus.');
    }

    // Tambahkan fungsi search di bawah ini
    public function search(Request $request)
    {
        // Validasi input pencarian
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        // Mencari buku berdasarkan judul atau penulis
        $results = Book::where('title', 'LIKE', "%{$query}%")
                       ->orWhere('author', 'LIKE', "%{$query}%")
                       ->get();

        // Mengarahkan ke tampilan hasil pencarian
        return view('books.search-results', compact('results', 'query'));
    }
    
    public function show(Book $book)
    {
        return view('admin.book.show', compact('book'));
    }

    public function bookCatalog()
    {
        // Mengambil seluruh koleksi buku dengan relasi kategori
        $books = Book::with('category')->paginate(12);

        // Mengirimkan data buku ke view 'book.catalog'
        return view('books.book-catalog', compact('books'));
    }
}
