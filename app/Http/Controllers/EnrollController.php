<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Take;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class EnrollController extends Controller
{
    public function index(){
        $courses = Course::all();
        return view('student.courses.index', compact('courses'));

    }

    public function enroll($id)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi login habis, silakan login lagi.');
        }

        $user = User::find($userId);

        if (!$user || !$user->student) {
            return redirect()->back()->with('error', 'Data mahasiswa untuk akun ini belum tersedia.');
        }

        $student = $user->student;

        // cek apakah course ada
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Course tidak ditemukan.');
        }

        // cek apakah sudah pernah ambil course
        $sudahAmbil = Take::where('STUDENT_ID', $student->STUDENT_ID)
                        ->where('COURSE_ID', $id)
                        ->exists();

        if ($sudahAmbil) {
            return redirect()->back()->with('error', 'Kamu sudah terdaftar di course ini.');
        }

        // simpan ke tabel TAKES
        Take::create([
            'STUDENT_ID' => $student->STUDENT_ID,
            'COURSE_ID'  => $id,
            'ENROLL_DATE'=> now(),
            'GRADE'      => 0.00,
            'STATUS'     => 'active',
        ]);

        return redirect()->route('student.courses.my')->with('success', 'Berhasil enroll ke course.');
    }


     public function myCourses()
    {
        $userId = session('user_id'); // konsisten pakai session
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi login habis, silakan login lagi.');
        }

        $user = User::find($userId);

        if (!$user || !$user->student) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $student = $user->student;

        // ambil courses lewat TAKES
        $takes = Take::with('course')
                    ->where('STUDENT_ID', $student->STUDENT_ID)
                    ->get();

        return view('student.courses.my', compact('takes'));
    }

}
