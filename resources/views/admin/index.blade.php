<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - Courses</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Halo, {{ session('user_name') }} ({{ session('user_role') }})</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <h2>Daftar Mata Kuliah</h2>
    <a href="{{ route('admin.courses.create') }}">+ Tambah Mata Kuliah</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->credits }}</td>
                <td>
                    <a href="{{ route('admin.courses.edit', $course->id) }}">Edit</a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
