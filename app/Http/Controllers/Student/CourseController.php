<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    public function index()
    {
        return view('student.courses.index');
    }

    public function show($id)
    {
        $course = \App\Models\Course::findOrFail($id);

        return view('student.courses.show', compact('course'));
    }
}
