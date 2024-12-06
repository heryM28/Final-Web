@extends('layouts.app')

@section('title', 'Become a Volunteer')

@section('content')
<div class="container mx-auto py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800">Become a Volunteer</h1>
        <p class="text-lg text-gray-600 mt-2">
            Thank you for considering volunteering with us! Fill out the form below to sign up.
        </p>
    </div>

    <!-- Display Status Message if Any -->
    @if(session('status'))
        <div class="bg-green-200 text-green-800 p-4 rounded-lg mb-6">
            {{ session('status') }}
        </div>
    @endif

    <!-- Volunteer Registration Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8 hover:shadow-xl transition duration-300 ease-in-out">
        <form action="/submit-volunteer" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-800">Full Name</label>
                <input type="text" id="name" name="name" class="p-2 border border-gray-300 rounded-md w-full" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-800">Email Address</label>
                <input type="email" id="email" name="email" class="p-2 border border-gray-300 rounded-md w-full" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-lg font-medium text-gray-800">Why do you want to volunteer?</label>
                <textarea id="message" name="message" class="p-2 border border-gray-300 rounded-md w-full" required></textarea>
            </div>
            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-800 transition-colors">
                Submit Application
            </button>
        </form>
    </div>
</div>
@endsection
