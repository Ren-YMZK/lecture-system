<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;



class CourseController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $courses = $student->courses;

        return view('student.courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = \App\Models\Course::findOrFail($id);

        return view('student.courses.show', compact('course'));
    }
}
