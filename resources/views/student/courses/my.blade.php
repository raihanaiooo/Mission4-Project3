@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Course Saya</h2>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Credits</th>
                <th>Status</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($takes as $index => $take)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $take->course->COURSE_CODE ?? '-' }}</td>
                <td>{{ $take->course->COURSE_NAME ?? '-' }}</td>
                <td>{{ $take->course->CREDITS ?? '-' }}</td>
                <td>{{ $take->STATUS }}</td>
                <td>{{ $take->GRADE }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
