<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role admin
Route::middleware(['auth.session', 'role:admin'])->group(function () {
    
    // Dashboard
    Route::get('/admin/dashboard', [CourseController::class, 'dashboard'])->name('admin.dashboard');

    // Resource routes untuk courses
    Route::resource('/admin/courses', CourseController::class)->names([
        'index'   => 'admin.courses.index',
        'create'  => 'admin.courses.create',
        'store'   => 'admin.courses.store',
        'show'    => 'admin.courses.show',
        'edit'    => 'admin.courses.edit',
        'update'  => 'admin.courses.update',
        'destroy' => 'admin.courses.destroy',
    ]);
});


// Route::middleware(['auth.session', 'role:admin'])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::get('/dashboard', [\App\Http\Controllers\CourseController::class, 'dashboard'])->name('dashboard');
//         Route::resource('courses', CourseController::class);
//     });

// Role student
Route::middleware(['auth.session', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});
