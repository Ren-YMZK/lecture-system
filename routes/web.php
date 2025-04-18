<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CourseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;
use App\Http\Controllers\Professor\CourseController as ProfessorCourseController;
use App\Http\Controllers\Professor\AssignmentController as ProfessorAssignmentController;
use App\Http\Controllers\Professor\SubmissionController as ProfessorSubmissionController;
use App\Http\Controllers\Professor\StudentController as ProfessorStudentController;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/student/courses');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/files/{filename}', function ($filename) {
    return Storage::response('public/submissions/' . $filename);
})->name('files.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/student/courses', [CourseController::class, 'index'])->name('student.courses.index');
});

Route::get('/', function () {
    return redirect('/dashboard'); // ログイン後は RouteServiceProvider::HOME へ
});

// 学生向けルート
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/assignments', [StudentAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}', [StudentAssignmentController::class, 'show'])->name('assignments.show');
    Route::post('/assignments/{assignment}/submit', [StudentAssignmentController::class, 'submit'])->name('assignments.submit');
});

// 教授向けルート
Route::middleware(['auth'])->prefix('professor')->name('professor.')->group(function () {
    Route::get('/courses', [ProfessorCourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [ProfessorCourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [ProfessorCourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [ProfessorCourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [ProfessorCourseController::class, 'update'])->name('courses.update');

    Route::get('/courses/{course}/assignments', [ProfessorAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}/submissions', [ProfessorSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/courses/{course}/students', [ProfessorStudentController::class, 'index'])->name('students.index');
    Route::delete('/courses/{course}', [ProfessorCourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('/assignments/create/{course}', [ProfessorAssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [ProfessorAssignmentController::class, 'store'])->name('assignments.store');

    Route::get('/assignments/{assignment}/edit', [ProfessorAssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('/assignments/{assignment}', [ProfessorAssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/assignments/{assignment}', [ProfessorAssignmentController::class, 'destroy'])->name('assignments.destroy');
    Route::get('/assignments/{assignment}/submissions', [App\Http\Controllers\Professor\SubmissionController::class, 'index'])->name('submissions.index');
    Route::post('/assignments/{assignment}/submit', [App\Http\Controllers\Student\AssignmentController::class, 'submit'])->name('assignments.submit');
    Route::put('/submissions/{submission}/score', [App\Http\Controllers\Professor\SubmissionController::class, 'score'])->name('submissions.score');
});


require __DIR__ . '/auth.php';
