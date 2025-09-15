<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8 flex-1">
        @yield('content')
    </main>


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center py-4">
        <p>&copy; {{ date('Y') }} My App. All rights reserved.</p>
    </footer>
</body>
</html>
