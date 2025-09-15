<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Take;
use App\Models\User;

class EnrollController extends Controller
{
    private function getStudentId()
    {
        $userId = session('user_id');
        if (!$userId) {
            abort(403, 'Sesi login habis, silakan login lagi.');
        }

        $user = User::find($userId);
        if (!$user || !$user->student) {
            abort(403, 'Data mahasiswa untuk akun ini belum tersedia.');
        }

        return $user->student->STUDENT_ID;
    }

    public function index()
    {
        $studentId = $this->getStudentId();

        // Ambil semua courses
        $courses = Course::all();

        // Ambil semua course yang sudah diambil student ini
        $userTakes = Take::where('STUDENT_ID', $studentId)
                         ->pluck('COURSE_ID')
                         ->toArray();

        return view('student.courses.index', compact('courses', 'userTakes'));
    }

    public function enroll($id)
    {
        $studentId = $this->getStudentId();

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
        try {
            Take::create([
                'STUDENT_ID' => $studentId,
                'COURSE_ID'  => $id,
                'ENROLL_DATE'=> now(),
                'GRADE'      => 0.00,
                'STATUS'     => 'active',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat enroll.');
        }

        return redirect()->back()->with('success', 'Berhasil enroll ke course.');
    }

    public function myCourses()
    {
        $studentId = $this->getStudentId();

        // Ambil courses lewat TAKES dengan eager load course
        $takes = Take::with('course')
                     ->where('STUDENT_ID', $studentId)
                     ->orderBy('ENROLL_DATE', 'desc')
                     ->get();

        return view('student.courses.my', compact('takes'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $studentId = $this->getStudentId();

        // Ambil daftar course yang sudah diambil student (optional)
        $userTakes = Take::where('STUDENT_ID', $studentId)
                         ->pluck('COURSE_ID')
                         ->toArray();

        return view('student.courses.show', compact('course', 'userTakes'));
    }
}
