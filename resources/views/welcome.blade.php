@extends('layouts.app')

@section('title', 'Welcome')

@section('meta')
    <meta name="description" content="Streamline your library operations with our comprehensive management system.">
    <meta name="keywords" content="Library Management, Catalog, Reports, Analytics, Member Management">
    <meta name="author" content="Your Library System">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Modern Library Management System">
    <meta property="og:description" content="Efficient and comprehensive management system for your library.">
    <meta property="og:image" content="/path/to/image.jpg">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Modern Library Management System">
    <meta name="twitter:description" content="Efficient and comprehensive management system for your library.">
    <meta name="twitter:image" content="/path/to/image.jpg">
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 text-white py-20 relative">
        <div class="absolute top-0 left-0 w-full h-full bg-blue-700 opacity-30"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-5xl sm:text-4xl lg:text-6xl font-bold mb-6 animate__animated animate__fadeInDown">
                Welcome to the Library Management System Hery
            </h1>
            <p class="text-xl mb-8 animate__animated animate__fadeInUp">
                An all-in-one platform to manage, organize, and enhance your library experience.
            </p>

            <!-- Kondisi untuk Login atau Daftar -->
            @if (Auth::check())
                <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-10 py-4 rounded-full text-lg font-semibold shadow-lg hover:bg-gray-100 hover:shadow-2xl transition-all duration-300">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-blue-600 px-10 py-4 rounded-full text-lg font-semibold shadow-lg hover:bg-gray-100 hover:shadow-2xl transition-all duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-10 py-4 rounded-full text-lg font-semibold shadow-lg hover:bg-gray-100 hover:shadow-2xl transition-all duration-300 mt-4">
                    Get Started Today
                </a>
            @endif
        </div>
    </div>

    <!-- Flash Message -->
    @if(session('message'))
        <div class="bg-blue-600 text-white p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Key Features Section -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-800 mb-12">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature Card -->
                @foreach ([
                    ['icon' => '/icons/catalog.svg', 'title' => 'Catalog Management', 'description' => 'Organize your book collections effortlessly.'],
                    ['icon' => '/icons/circulation.svg', 'title' => 'Circulation System', 'description' => 'Efficient book check-in and check-out processes.'],
                    ['icon' => '/icons/analytics.svg', 'title' => 'Reports & Analytics', 'description' => 'Gain insights from library usage trends.'],
                    ['icon' => '/icons/members.svg', 'title' => 'Member Management', 'description' => 'Manage member profiles and activities effectively.']
                ] as $feature)
                <div class="bg-blue-100 p-6 rounded-lg shadow-md text-center transform hover:scale-105 transition duration-300">
                    <div class="w-16 h-16 mx-auto mb-4">
                        <img src="{{ $feature['icon'] }}" alt="{{ $feature['title'] }}" class="w-full h-full">
                    </div>
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-blue-700">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-blue-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ([
                    ['stat' => '10K+', 'label' => 'Books Managed'],
                    ['stat' => '500+', 'label' => 'Active Users'],
                    ['stat' => '99%', 'label' => 'Satisfaction Rate'],
                    ['stat' => '24/7', 'label' => 'Support']
                ] as $stat)
                <div class="p-6 animate__animated animate__fadeIn">
                    <h3 class="text-4xl font-bold text-blue-400 mb-2">{{ $stat['stat'] }}</h3>
                    <p class="text-gray-200">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-800 mb-12">What Our Users Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ([
                    ['quote' => 'This system has transformed the way we manage our library. Highly recommended!', 'author' => 'John Doe'],
                    ['quote' => 'User-friendly and packed with features. A must-have for libraries!', 'author' => 'Jane Smith'],
                    ['quote' => 'The analytics feature is a game changer for decision-making.', 'author' => 'David Brown']
                ] as $testimonial)
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <p class="text-blue-600 italic mb-4">"{{ $testimonial['quote'] }}"</p>
                    <h4 class="text-blue-800 font-semibold">{{ $testimonial['author'] }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-blue-600 text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6">Ready to Revolutionize Your Library?</h2>
            <p class="mb-8">Join thousands of libraries improving their operations today.</p>
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-10 py-4 rounded-full font-semibold shadow-lg hover:bg-gray-100 hover:shadow-2xl transition-all duration-300">
                Get Started Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Modern Library Management System. All Rights Reserved.</p>
            <ul class="flex justify-center mt-4 space-x-4">
                <li><a href="{{ route('privacy-policy') }}" class="text-blue-400 hover:underline">Privacy Policy</a></li>
                <li><a href="{{ route('terms-of-service') }}" class="text-blue-400 hover:underline">Terms of Service</a></li>
                <li><a href="{{ route('faq') }}" class="text-blue-400 hover:underline">FAQ</a></li>
                <li><a href="{{ route('contact-us') }}" class="text-blue-400 hover:underline">Contact Us</a></li>
            </ul>
        </div>
    </footer>
@endsection
