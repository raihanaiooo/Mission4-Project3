<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // READ
    public function dashboard()
    {
        $courses = Course::all(); // Ambil semua course
        return view('admin.dashboard', compact('courses'));
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
            'COURSE_CODE'  => 'nullable|string|max:20',
            'COURSE_NAME'  => 'required|string|max:100',
            'DESCRIPTION'  => 'nullable|string',
            'CREDITS'      => 'required|numeric|min:0',
            'IMAGE'        => 'nullable|string|max:255',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Course created successfully!');
    }

    // SHOW (detail per course)
    public function show(Course $course)
    {
        return view('admin.show', compact('course'));
    }


    // EDIT
    // public function edit($id){
    //     $course = Course::findOrFail($id);
    //     return view('admin.edit', compact('course'));
    // }
    public function edit(Course $course)
    {
        return view('admin.edit', compact('course'));
    }

    // UPDATE
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'COURSE_CODE'  => 'nullable|string|max:20',
            'COURSE_NAME'  => 'required|string|max:100',
            'DESCRIPTION'  => 'nullable|string',
            'CREDITS'      => 'required|numeric|min:0',
            'IMAGE'        => 'nullable|string|max:1024',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Course updated successfully!');
    }

    // DELETE
    public function destroy(Course $course) {
        $course->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Course deleted successfully!');
    }
}
