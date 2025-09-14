@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Course</h2>

    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="course_code" class="form-label">Course Code</label>
            <input type="text" name="course_code" id="course_code" class="form-control" value="{{ old('course_code') }}" required>
            @error('course_code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ old('course_name') }}" required>
            @error('course_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Credits</label>
            <input type="number" step="0.01" name="credits" id="credits" class="form-control" value="{{ old('credits') }}" required>
            @error('credits') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Course Image</label>
            <input type="file" name="image" id="image" class="form-control">
            if($request->hasFile('image')){
                $path = $request->file('image')->store('courses', 'public');
                $data['IMAGE'] = $path;
            }
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
