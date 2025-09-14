@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Course Detail</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $course->COURSE_ID }}</p>
            <p><strong>Code:</strong> {{ $course->COURSE_CODE }}</p>
            <p><strong>Name:</strong> {{ $course->COURSE_NAME }}</p>
            <p><strong>Description:</strong> {{ $course->DESCRIPTION }}</p>
            <p><strong>Credits:</strong> {{ $course->CREDITS }}</p>
            @if($course->IMAGE)
                <p><strong>Image:</strong><br>
                <img src="{{ asset('storage/'.$course->IMAGE) }}" alt="Course Image" width="200"></p>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.courses.dashboard') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
