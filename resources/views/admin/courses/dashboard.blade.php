<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gray-900 text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <p class="text-sm">
                Halo, <span class="font-semibold">{{ session('user_name') }}</span> 
                ({{ session('user_role') }})
            </p>
        </div>
    </header>

    <!-- Main -->
    <main class="container mx-auto px-6 py-8 flex-1">
        <!-- Tombol tambah -->
        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('admin.courses.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                + Tambah Course
            </a>
        </div>

        <!-- Flash message -->
        @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Kode</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Credits</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $course->COURSE_CODE }}</td>
                            <td class="px-4 py-2">{{ $course->COURSE_NAME }}</td>
                            <td class="px-4 py-2">{{ $course->CREDITS }}</td>
                            <td class="px-4 py-2">
                                @if($course->IMAGE)
                                    <img src="{{ asset('storage/'.$course->IMAGE) }}" class="w-16 h-16 object-cover rounded-md">
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.courses.show', $course->COURSE_ID) }}" 
                                   class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('admin.courses.edit', $course->COURSE_ID) }}" 
                                   class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course->COURSE_ID) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin hapus?')" 
                                            class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center py-4">
        <p>&copy; {{ date('Y') }} My App. All rights reserved.</p>
    </footer>

</body>
</html>
