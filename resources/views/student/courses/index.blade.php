@extends('layouts.app')

@include('layouts.navbar-student')
@section('content')

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-4">Student Dashboard</h1>

    <h2 class="text-2xl font-semibold mb-4">Daftar Courses</h2>

    @if($courses->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-xl transition duration-300">
                    <h3 class="text-lg font-bold mb-2">{{ $course->COURSE_NAME }}</h3>
                    <p class="text-gray-600 mb-1"><strong>Kode:</strong> {{ $course->COURSE_CODE }}</p>
                    <p class="text-gray-600 mb-3"><strong>Credits:</strong> {{ $course->CREDITS }}</p>
                    <form action="{{ route('student.courses.enroll', ['id' => $course->COURSE_ID]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md transition w-full">Enroll</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Belum ada course tersedia.</p>
    @endif
</div>
@endsection
