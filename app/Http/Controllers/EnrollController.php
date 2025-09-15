<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Take;
use App\Models\User;

class EnrollController extends Controller
{
    // Menampilkan semua courses dengan status enrolled
    public function index()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi login habis, silakan login lagi.');
        }

        $user = User::find($userId);
        if (!$user || !$user->student) {
            return redirect()->back()->with('error', 'Data mahasiswa untuk akun ini belum tersedia.');
        }

        $studentId = $user->student->STUDENT_ID;

        // Ambil semua courses
        $courses = Course::all();

        // Ambil semua course yang sudah diambil student ini
        $userTakes = Take::where('STUDENT_ID', $studentId)
                         ->pluck('COURSE_ID')
                         ->toArray();

        return view('student.courses.index', compact('courses', 'userTakes'));
    }

    // Enroll ke course
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

        $studentId = $user->student->STUDENT_ID;

        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Course tidak ditemukan.');
        }

        // Cek apakah sudah pernah ambil course
        $sudahAmbil = Take::where('STUDENT_ID', $studentId)
                          ->where('COURSE_ID', $id)
                          ->exists();

        if ($sudahAmbil) {
            return redirect()->back()->with('error', 'Kamu sudah terdaftar di course ini.');
        }

        // Simpan ke tabel TAKES
        Take::create([
            'STUDENT_ID' => $studentId,
            'COURSE_ID'  => $id,
            'ENROLL_DATE'=> now(),
            'GRADE'      => 0.00,
            'STATUS'     => 'active',
        ]);

        return redirect()->route('student.courses.my')->with('success', 'Berhasil enroll ke course.');
    }

    // Menampilkan courses yang sudah diambil student
    public function myCourses()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi login habis, silakan login lagi.');
        }

        $user = User::find($userId);
        if (!$user || !$user->student) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $studentId = $user->student->STUDENT_ID;

        // Ambil courses lewat TAKES dengan eager load course
        $takes = Take::with('course')
                     ->where('STUDENT_ID', $studentId)
                     ->get();

        return view('student.courses.my', compact('takes'));
    }
}
