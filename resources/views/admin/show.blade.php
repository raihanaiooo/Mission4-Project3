@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Course Detail</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $course->course_id }}</p>
            <p><strong>Code:</strong> {{ $course->course_code }}</p>
            <p><strong>Name:</strong> {{ $course->course_name }}</p>
            <p><strong>Description:</strong> {{ $course->description }}</p>
            <p><strong>Credits:</strong> {{ $course->credits }}</p>

            @if($course->image)
                <p><strong>Image:</strong><br>
                <img src="{{ asset('storage/'.$course->image) }}" alt="Course Image" width="200"></p>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
