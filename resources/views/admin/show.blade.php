@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Course Detail</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $course->id }}</p>
            <p><strong>Name:</strong> {{ $course->course_name }}</p>
            <p><strong>Credits:</strong> {{ $course->credits }}</p>
        </div>
    </div>

    <a href="{{ route('admin.courses.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
