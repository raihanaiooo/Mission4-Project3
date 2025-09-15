@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Dashboard</h1>
    <p>Halo, {{ session('user_name') }} ({{ session('user_role') }})</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    <h2>Daftar Courses</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Credits</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $index => $course)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $course->COURSE_CODE }}</td>
                <td>{{ $course->COURSE_NAME }}</td>
                <td>{{ $course->CREDITS }}</td>
                <td>
                    <form action="{{ route('student.courses.enroll', ['id' => $course->COURSE_ID]) }}" method="POST">
                        @csrf
                        <button type="submit">Enroll</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
