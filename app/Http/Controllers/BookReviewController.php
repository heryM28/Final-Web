<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookReviewController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book->reviews()->create([
            $user = Auth::user(),
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.show', $book);
    }

    public function index(Book $book)
    {
        $reviews = $book->reviews;
        return view('books.reviews.index', compact('book', 'reviews'));
    }
}
