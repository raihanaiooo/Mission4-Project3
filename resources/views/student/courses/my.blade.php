@extends('layouts.app')
@include('layouts.navbar-student')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-semibold mb-6">Course Saya</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 border-b">No</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 border-b">Kode</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 border-b">Nama</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 border-b">Credits</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 border-b">Status</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700 border-b">Grade</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($takes as $index => $take)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $take->course->COURSE_CODE ?? '-' }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $take->course->COURSE_NAME ?? '-' }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $take->course->CREDITS ?? '-' }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            {{ $take->STATUS === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($take->STATUS) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $take->GRADE }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
