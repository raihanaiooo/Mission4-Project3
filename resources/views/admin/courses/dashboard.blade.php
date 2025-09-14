<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - Courses</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Halo, {{ session('user_name') }} ({{ session('user_role') }})</p>

    <a href="{{ route('admin.courses.create') }}">Tambah Course</a>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Credits</th>
            <th>Image</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->COURSE_ID }}</td>
            <td>{{ $course->COURSE_CODE }}</td>
            <td>{{ $course->COURSE_NAME }}</td>
            <td>{{ $course->CREDITS }}</td>
            <td>
                @if($course->IMAGE)
                    <img src="{{ asset('storage/'.$course->IMAGE) }}" width="60">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.courses.show', $course->COURSE_ID) }}">Detail</a> |
                <a href="{{ route('admin.courses.edit', $course->COURSE_ID) }}">Edit</a> |
                <form action="{{ route('admin.courses.destroy', $course->COURSE_ID) }}" method="POST" style="display:inline">
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
