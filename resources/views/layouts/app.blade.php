<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') 
    {{-- kalau belum pakai Vite, bisa ganti pakai CDN: <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-md">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold tracking-wide hover:text-blue-400 transition">
                My App
            </a>

            <div class="hidden md:flex space-x-6">
                {{-- Navigasi dinamis berdasarkan role --}}
                @if(session('user_role') === 'student')
                    <a href="{{ route('student.dashboard') }}" class="hover:text-blue-400">Dashboard</a>
                    <a href="{{ route('student.courses') }}" class="hover:text-blue-400">My Courses</a>
                @elseif(session('user_role') === 'admin')
                    <a href="{{ route('admin.courses.dashboard') }}" class="hover:text-blue-400">Dashboard</a>
                    <a href="{{ route('admin.courses.index') }}" class="hover:text-blue-400">Manage Courses</a>
                    <a href="{{ route('admin.users.index') }}" class="hover:text-blue-400">Manage Users</a>
                @endif
            </div>

            <div class="flex items-center space-x-4">
                <span class="hidden sm:block">{{ session('user_name') }} ({{ session('user_role') }})</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8 flex-1">
        <div class="bg-white shadow-lg rounded-xl p-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center py-4">
        <p>&copy; {{ date('Y') }} My App. All rights reserved.</p>
    </footer>
</body>
</html>
