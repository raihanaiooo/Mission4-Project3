@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Course</h2>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Course Code -->
        <div>
            <label for="course_code" class="block text-sm font-medium text-gray-700 mb-1">Course Code</label>
            <input type="text" name="course_code" id="course_code" 
                   placeholder="Enter course code"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('course_code', $course->COURSE_CODE) }}" required>
            @error('course_code') 
                <small class="text-red-600">{{ $message }}</small> 
            @enderror
        </div>

        <!-- Course Name -->
        <div>
            <label for="course_name" class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
            <input type="text" name="course_name" id="course_name" 
                   placeholder="Enter course name"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('course_name', $course->COURSE_NAME) }}" required>
            @error('course_name') 
                <small class="text-red-600">{{ $message }}</small> 
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      placeholder="Write a brief description of the course"
                      class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $course->DESCRIPTION) }}</textarea>
            @error('description') 
                <small class="text-red-600">{{ $message }}</small> 
            @enderror
        </div>

        <!-- Credits -->
        <div>
            <label for="credits" class="block text-sm font-medium text-gray-700 mb-1">Credits</label>
            <input type="number" step="0.01" name="credits" id="credits" 
                   placeholder="e.g., 3.0"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('credits', $course->CREDITS) }}" required>
            @error('credits') 
                <small class="text-red-600">{{ $message }}</small> 
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Course Image</label>
            @if($course->IMAGE)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$course->IMAGE) }}" alt="Course Image" class="w-32 h-32 object-cover rounded-md shadow">
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg shadow-sm mt-1 px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('IMAGE') 
                <small class="text-red-600">{{ $message }}</small> 
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex items-center space-x-4">
            <button type="submit" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                Update
            </button>
            <a href="{{ route('admin.courses.dashboard') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        let valid = true;

        const courseCode = document.getElementById('course_code');
        const courseName = document.getElementById('course_name');
        const credits = document.getElementById('credits');

        // Hapus error lama
        document.querySelectorAll('small.js-error').forEach(el => el.remove());

        // Reset border
        [courseCode, courseName, credits].forEach(el => el.style.borderColor = '#d1d5db'); // gray-300

        // ===== Course Code =====
        if (!courseCode.value.trim()) {
            valid = false;
            courseCode.style.borderColor = '#dc2626';
            courseCode.insertAdjacentHTML('afterend', '<small class="text-red-600 js-error">Course code is required</small>');
        } else if (courseCode.value.length > 20) {
            valid = false;
            courseCode.style.borderColor = '#dc2626';
            courseCode.insertAdjacentHTML('afterend', '<small class="text-red-600 js-error">Course code cannot exceed 20 characters</small>');
        }

        // ===== Course Name =====
        if (!courseName.value.trim()) {
            valid = false;
            courseName.style.borderColor = '#dc2626';
            courseName.insertAdjacentHTML('afterend', '<small class="text-red-600 js-error">Course name is required</small>');
        }

        // ===== Credits =====
        const creditsValue = parseFloat(credits.value);
        if (!credits.value || isNaN(creditsValue) || creditsValue <= 0) {
            valid = false;
            credits.style.borderColor = '#dc2626';
            credits.insertAdjacentHTML('afterend', '<small class="text-red-600 js-error">Credits must be a positive number</small>');
        } else if (creditsValue > 6.00) {
            valid = false;
            credits.style.borderColor = '#dc2626';
            credits.insertAdjacentHTML('afterend', '<small class="text-red-600 js-error">Credits cannot exceed 4.00</small>');
        }

        if (!valid) e.preventDefault();
    });
});
</script>
