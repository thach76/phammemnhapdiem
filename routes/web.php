<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('students', StudentController::class);
// Route::resource('classes', ClassController::class);
// Route::resource('teachers', TeacherController::class);
// Route::resource('users', UserController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('classrooms', ClassroomController::class);

    // thêm route phụ cho nested CRUD
    Route::get('classrooms/{classroom}/students', [ClassroomController::class, 'students'])->name('classrooms.students');
    Route::post('classrooms/{classroom}/students', [ClassroomController::class, 'storeStudent'])->name('classrooms.students.store');
    Route::delete('classrooms/{classroom}/students/{student}', [ClassroomController::class, 'destroyStudent'])->name('classrooms.students.destroy');

    Route::get('classrooms/{classroom}/subjects', [ClassroomController::class, 'subjects'])->name('classrooms.subjects');
    Route::post('classrooms/{classroom}/subjects', [ClassroomController::class, 'storeSubject'])->name('classrooms.subjects.store');
    Route::delete('classrooms/{classroom}/subjects/{subject}', [ClassroomController::class, 'destroySubject'])->name('classrooms.subjects.destroy');

    Route::get('classrooms/{classroom}/scores', [ClassroomController::class, 'scores'])->name('classrooms.scores');
    Route::post('classrooms/{classroom}/scores', [ClassroomController::class, 'storeScore'])->name('classrooms.scores.store');
});


require __DIR__.'/auth.php';
