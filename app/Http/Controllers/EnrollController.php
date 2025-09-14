<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Take;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('students.courses.index', compact('courses'));

    }

    public function enroll(Course $course){
        $student = Auth::user()->student;

        Take::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'enroll_date' => now(),
            'grade' => 0
        ]);

        return back()->with('success', 'Berhasil enroll course');
    }
}
