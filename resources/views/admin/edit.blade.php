@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Course</h2>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_code" class="form-label">Course Code</label>
            <input type="text" name="course_code" id="course_code" class="form-control" value="{{ old('course_code', $course->course_code) }}" required>
            @error('course_code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ old('course_name', $course->course_name) }}" required>
            @error('course_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $course->description) }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" step="0.01" name="credits" id="credits" class="form-control" value="{{ old('credits', $course->credits) }}" required>
            @error('credits') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Course Image</label><br>
            @if($course->image)
                <img src="{{ asset('storage/'.$course->image) }}" alt="Course Image" width="120" class="mb-2">
            @endif
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('courses', 'public');
            }


            <input type="file" name="image" id="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>

    </form>
</div>
@endsection
