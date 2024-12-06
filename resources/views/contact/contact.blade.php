@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800">Get in Touch</h1>
        <p class="text-lg text-gray-600 mt-2">
            We'd love to hear from you! Feel free to send us a message for any inquiries or feedback.
        </p>
    </div>

    <div class="flex flex-col lg:flex-row justify-center items-center lg:items-start space-y-8 lg:space-y-0 lg:space-x-12">
        <!-- Contact Info Section -->
        <div class="w-full lg:w-1/3 text-center lg:text-left bg-gray-100 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Contact Information</h2>
            <p class="text-gray-600 mb-4">
                <i class="fas fa-envelope text-blue-500 mr-2"></i>
                contact@yourwebsite.com
            </p>
            <p class="text-gray-600 mb-4">
                <i class="fas fa-phone text-blue-500 mr-2"></i>
                +123 456 7890
            </p>
            <p class="text-gray-600">
                <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                123 Your Street, City, Country
            </p>
        </div>

        <!-- Form Section -->
        <div class="w-full lg:w-2/3">
            <form action="{{ route('contact.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                        placeholder="Enter your name" required>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                        placeholder="Enter your email" required>
                </div>

                <!-- Message Field -->
                <div>
                    <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="5"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                        placeholder="Write your message here" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full p-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold text-lg rounded-md hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200 ease-in-out">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
