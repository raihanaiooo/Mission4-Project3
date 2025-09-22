<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // READ
    public function dashboard(Request $request)
    {
        $query = Course::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('COURSE_NAME', 'like', "%{$search}%")
                  ->orWhere('COURSE_CODE', 'like', "%{$search}%");
        }

        $courses = $query->orderBy('COURSE_ID')->get();

        // Array of object untuk Blade
        $coursesJson = $courses->map(function($course) {
            return [
                'COURSE_ID'   => $course->COURSE_ID,
                'COURSE_CODE' => $course->COURSE_CODE,
                'COURSE_NAME' => $course->COURSE_NAME,
                'DESCRIPTION' => $course->DESCRIPTION,
                'CREDITS'     => $course->CREDITS,
                'IMAGE'       => $course->IMAGE,
            ];
        });

        return view('admin.courses.dashboard', compact('coursesJson'));
    }

    // CREATE
    public function create()
    {
        return view('admin.courses.create');
    }

    // DETAIL/SHOW
        public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'nullable|string|max:20|unique:courses,COURSE_CODE',
            'course_name' => 'required|string|max:100|unique:courses,COURSE_NAME',
            'credits'     => 'required|numeric|min:0|max:4',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = [
            'COURSE_CODE' => $request->course_code,
            'COURSE_NAME' => $request->course_name,
            'DESCRIPTION' => $request->description,
            'CREDITS'     => $request->credits,
        ];

        if ($request->hasFile('image')) {
            $data['IMAGE'] = $request->file('image')->store('courses','public');
        }

        Course::create($data);

        return redirect()->route('admin.courses.dashboard')->with('success', 'Course created successfully!');
    }

    // EDIT
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    // UPDATE 
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code' => 'nullable|string|max:20|unique:courses,COURSE_CODE',
            'course_name' => 'required|string|max:100|unique:courses,COURSE_NAME',
            'credits'     => 'required|numeric|min:0|max:4',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = [
            'COURSE_CODE' => $request->course_code,
            'COURSE_NAME' => $request->course_name,
            'DESCRIPTION' => $request->description,
            'CREDITS'     => $request->credits,
        ];

        if ($request->hasFile('image')) {
            $data['IMAGE'] = $request->file('image')->store('courses','public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.dashboard')->with('success', 'Course updated successfully!');
    }

    // DELETE
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.dashboard')->with('success', 'Course deleted successfully!');
    }
}
