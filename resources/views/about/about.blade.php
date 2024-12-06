@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="container mx-auto py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 transition-transform transform hover:scale-105">About Us</h1>
        <p class="text-lg text-gray-600 mt-2 max-w-3xl mx-auto transition-opacity duration-300 ease-in-out hover:opacity-80">
            Welcome to our library management system. This system is designed to make book borrowing, management, and cataloging easier for everyone. Our goal is to provide seamless access to books for students, staff, and administrators alike.
        </p>
    </div>

    <!-- Our Mission Section -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our Mission</h2>
        <p class="text-lg text-gray-600">
            We aim to make the process of managing and borrowing books efficient and user-friendly. We strive to provide an intuitive experience that fosters the love for reading and learning.
        </p>
    </div>

    <!-- Our History Section -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our History</h2>
        <p class="text-lg text-gray-600">
            Our library has been serving the community for over 20 years. From its humble beginnings as a small reading room to becoming a comprehensive digital library, we have always aimed to provide the best resources for our users.
        </p>
    </div>

    <!-- Our Vision Section -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our Vision</h2>
        <p class="text-lg text-gray-600">
            To create a knowledge-driven society where students, staff, and community members can easily access educational resources to enhance their learning and professional growth.
        </p>
    </div>

    <!-- User Testimonials Section -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">What Our Users Say</h2>
        <blockquote class="text-lg text-gray-600 mt-2 italic border-l-4 border-blue-600 pl-4">
            "This library system has made borrowing and managing books so much easier! Highly recommended." - Alice
        </blockquote>
    </div>

    <!-- FAQ Section -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">FAQ</h2>
        <div class="mt-4">
            <h3 class="text-lg font-medium text-gray-800">How do I borrow a book?</h3>
            <p class="text-gray-600">You can log in to your account, search for the book you want, and place a borrowing request.</p>
        </div>
        <div class="mt-4">
            <h3 class="text-lg font-medium text-gray-800">Who can access this system?</h3>
            <p class="text-gray-600">Students, staff, and administrators with valid credentials can access the system.</p>
        </div>
    </div>

    <!-- Call to Action for Volunteering -->
    <div class="text-center mt-12">
        <a href="/volunteer" class="bg-green-600 text-white px-8 py-4 rounded-full hover:bg-green-800 transition-colors text-lg transform hover:scale-105">
            Become a Volunteer
        </a>
    </div>

    <!-- Social Media Links -->
    <div class="text-center mt-12">
        <p class="text-lg text-gray-600">Follow us on:</p>
        <div class="space-x-6 mt-4">
            <a href="https://facebook.com/ourlibrary" class="text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out transform hover:scale-105" target="_blank" rel="noopener noreferrer">Facebook</a>
            <a href="https://twitter.com/ourlibrary" class="text-blue-400 hover:text-blue-600 transition duration-300 ease-in-out transform hover:scale-105" target="_blank" rel="noopener noreferrer">Twitter</a>
            <a href="https://instagram.com/ourlibrary" class="text-pink-600 hover:text-pink-800 transition duration-300 ease-in-out transform hover:scale-105" target="_blank" rel="noopener noreferrer">Instagram</a>
            <a href="https://linkedin.com/company/ourlibrary" class="text-blue-700 hover:text-blue-900 transition duration-300 ease-in-out transform hover:scale-105" target="_blank" rel="noopener noreferrer">LinkedIn</a>
        </div>
    </div>

    <!-- Location and Hours Section -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Location & Hours</h2>
        <p class="text-lg text-gray-600">
            Our library is located at 123 Library St., Knowledge City. We are open from Monday to Friday, 9:00 AM to 6:00 PM. Closed on weekends and public holidays.
        </p>
    </div>

    <!-- Newsletter Subscription -->
    <div class="bg-green-50 p-8 rounded-lg shadow-lg mb-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:translate-y-2 hover:opacity-90">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Subscribe to Our Newsletter</h2>
        <p class="text-lg text-gray-600 mt-2">Stay updated with the latest books, events, and library news by subscribing to our newsletter.</p>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="text-red-600 mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="text-green-600 mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Newsletter Form -->
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-4">
            @csrf
            <div class="flex justify-center">
                <input type="email" name="email" placeholder="Enter your email" class="p-3 border border-gray-300 rounded-md w-2/3 md:w-1/2 transition-transform duration-300 ease-in-out transform hover:scale-105">
                <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-800 transition-colors transform hover:scale-105">
                    Subscribe
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
