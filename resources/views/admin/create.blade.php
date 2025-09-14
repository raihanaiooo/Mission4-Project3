@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Course</h2>

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ old('course_name') }}" required>
            @error('course_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" step="0.01" name="credits" id="credits" class="form-control" value="{{ old('credits') }}" required>
            @error('credits') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
