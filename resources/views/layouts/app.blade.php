<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>   
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Link Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body
    class="bg-gray-100 overflow-hidden"
    x-data="{
        sidebarOpen: false,
        openSidebarOnHover() {
            this.sidebarOpen = true;
        },
        closeSidebarOnLeave() {
            this.sidebarOpen = false;
        }
    }"
>
    <!-- Sidebar -->
    <div
        @mouseenter="openSidebarOnHover()"
        @mouseleave="closeSidebarOnLeave()"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-blue-600 transform transition-transform duration-300 animate__animated animate__fadeIn"
        :class="{
            '-translate-x-full': !sidebarOpen,
            'translate-x-0': sidebarOpen
        }"
    >
        <div class="flex flex-col h-full">
            <div class="p-4">
                <a href="{{ url('/') }}" class="text-white text-xl font-semibold animate__animated animate__fadeIn">LibrarySys</a>
            </div>
            <nav class="flex-1 px-4 py-4">
                <div class="flex flex-col space-y-4">
                    <!-- Guest Navigation -->
                    @guest
                        <div class="pt-4 border-t border-blue-500">
                            <a href="{{ route('register') }}" class="text-white hover:text-gray-300 block mb-3 animate__animated animate__fadeIn">Register</a>
                            <a href="{{ route('login') }}" class="text-white hover:text-gray-300 block mb-3 animate__animated animate__fadeIn">Login</a>
                        </div>
                    @endguest

                    @auth
                        @switch(auth()->user()->role)
                            @case('student')
                                <a href="{{ route('mahasiswa.dashboard') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Student Dashboard</a>
                                @break
                            @case('admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Admin Dashboard</a>
                                <a href="{{ route('admin.loans.index') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Daftar Peminjam</a>
                                @break
                            @case('staff')
                                <a href="{{ route('pegawai.dashboard') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Staff Dashboard</a>
                                <a href="{{ route('admin.loans.index') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Daftar Peminjam</a>
                                @break
                        @endswitch
                    @endauth

                    <!-- Common Navigation -->
                    <a href="{{ route('home') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Homepage</a>
                    <a href="{{ route('books.book-catalog') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Book Catalog</a>
                    <a href="{{ route('features') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Features</a>
                    <a href="{{ route('about') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">About</a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-gray-300 animate__animated animate__fadeIn">Contact</a>

                    @auth
                    <div class="pt-4 border-t border-blue-500">
                        <a href="{{ route('profile.show') }}" class="text-white hover:text-gray-300 block mb-3 animate__animated animate__fadeIn">User Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-300 w-full text-left animate__animated animate__fadeIn">Logout</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="fixed inset-0 overflow-hidden">
        <!-- Top Navigation Bar -->
        <nav class="absolute top-0 left-0 right-0 bg-blue-600 text-white p-4 z-30 animate__animated animate__fadeIn">
            <div class="container mx-auto flex justify-between items-center group">
                <div class="relative w-12 h-8" @mouseenter="openSidebarOnHover()">
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="absolute left-0 top-0 text-white focus:outline-none"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Scrollable Content Area -->
        <div class="absolute top-16 bottom-0 left-0 right-0 overflow-y-auto">
            <!-- Page Content -->
            <div class="container mx-auto py-6 px-4">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white text-center py-4">
                <p>&copy; {{ date('Y') }} LibrarySys. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"
    ></div>
</body>

<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');

    togglePasswordButton.addEventListener('click', () => {
        // Toggle between 'password' and 'text' types
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Change the button icon (optional)
        togglePasswordButton.textContent = type === 'password' ? '👁️' : '🙈';
    });

    let table = new DataTable('#myTable');
</script>
 
</html>
