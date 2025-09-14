<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // READ
    public function index()
    {
        $courses = Course::all();
        return view('admin.index', compact('courses'));
    }

    // CREATE
    public function create()
    {
        return view('admin.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'credits' => 'required|numeric|min:0',
        ]);

        Course::create($request->only('course_name', 'credits'));

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
    }

    // SHOW (detail per course)
    public function show(Course $course)
    {
        return view('admin.show', compact('course'));
    }

    // EDIT
    public function edit($id){
        $course = Course::findOrFail($id);
        return view('admin.edit', compact('course'));
    }

    // UPDATE
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'credits' => 'required|numeric|min:0',
        ]);

        $course->update($request->only('course_name', 'credits'));

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    // DELETE
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
    }
}
