<nav class="bg-white shadow-md mb-6">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold">
            MyApp
        </div>
        <div class="space-x-4">
            <a href="{{ route('student.courses.index') }}" class="text-gray-700 hover:text-blue-600 transition">Courses</a>
            <a href="{{ route('student.courses.my') }}" class="text-gray-700 hover:text-blue-600 transition">My Courses</a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md transition">Logout</button>
        </form>
    </div>
</nav>
