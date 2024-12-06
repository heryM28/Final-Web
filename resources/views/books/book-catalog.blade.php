@extends('layouts.app')

@section('title', 'Book Catalog')

@section('content')
<div class="container mx-auto py-8">

    <!-- Title of the Page -->
    <h1 class="text-4xl font-bold text-center text-green-600 mb-8">Book Catalog</h1>

    <!-- Search Form -->
    <div class="mt-8 max-w-md mx-auto p-6 bg-white shadow-lg rounded-lg border border-gray-200 mb-8">
        <h2 class="text-xl font-semibold text-center text-gray-800 mb-4">Cari Buku</h2>
        <input
            type="text"
            id="searchQuery"
            placeholder="Cari buku berdasarkan judul atau penulis"
            class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-80 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            oninput="filterBooks()">
    </div>

    <!-- Daftar Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="bookList">
        @foreach($books as $book)
        <div class="book-item bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}">
            <!-- Book Cover Placeholder -->
            <div class="h-48 w-full bg-gray-200 rounded-lg flex items-center justify-center">
                <span class="text-gray-400 text-xl">Book Cover</span>
            </div>

            <!-- Book Details -->
            <div class="mt-4">
                <h2 class="text-xl font-bold text-gray-800 truncate">{{ $book->title }}</h2>
                <p class="text-gray-600 mt-1"><strong>Author:</strong> {{ $book->author }}</p>
                <p class="text-gray-600 mt-1"><strong>Category:</strong> {{ $book->category->name }}</p>
                <p class="text-gray-600 mt-1"><strong>Stock:</strong> {{ $book->stock }} available</p>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('admin.book.show', $book->id) }}" 
                   class="text-sm font-medium text-green-600 hover:text-green-800 transition-colors">See Details</a>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    Borrow
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $books->links('pagination::tailwind') }}
    </div>
</div>

<script>
    // Function to filter books based on search query
    function filterBooks() {
        const query = document.getElementById('searchQuery').value.toLowerCase();
        const books = document.querySelectorAll('.book-item');

        books.forEach(book => {
            const title = book.getAttribute('data-title');
            const author = book.getAttribute('data-author');

            if (title.includes(query) || author.includes(query)) {
                book.style.display = 'block';  // Show matching book
            } else {
                book.style.display = 'none';  // Hide non-matching book
            }
        });
    }
</script>

@endsection
