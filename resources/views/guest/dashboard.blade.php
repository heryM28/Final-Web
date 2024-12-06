@extends('layouts.app')

@section('title', 'Guest Dashboard')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Welcome to the Guest Dashboard</h1>
        <p class="text-lg text-gray-600 mt-2">
            As a guest, you have limited access to the library system. Please explore the catalog or consider registering for more features.
        </p>
    </div>

    <div class="text-center">
        <!-- Informasi Fitur Terbatas -->
        <div class="bg-yellow-100 p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-semibold text-yellow-800">Limited Access</h2>
            <p class="text-gray-600 mt-2">
                As a guest, you can explore the catalog and view available books. To enjoy more features such as borrowing books and managing your account, please <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 transition-colors">register</a> or <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 transition-colors">log in</a>.
            </p>
        </div>

        <!-- Button Explore Catalog -->
        <a href="{{ route('catalog') }}" class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
            Explore Catalog
        </a>
    </div>
</div>
@endsection
