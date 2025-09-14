@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Course</h2>

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ old('course_name', $course->course_name) }}" required>
            @error('course_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" step="0.01" name="credits" id="credits" class="form-control" value="{{ old('credits', $course->credits) }}" required>
            @error('credits') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
