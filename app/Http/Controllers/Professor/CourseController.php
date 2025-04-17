<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        // ログイン中の教授が作成した講義だけ取得
        $courses = Course::where('created_by', Auth::id())->get();

        return view('professor.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('professor.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('professor.courses.index');
    }

    public function edit($id)
    {
        $course = \App\Models\Course::findOrFail($id);

        return view('professor.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = \App\Models\Course::findOrFail($id);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('professor.courses.index')->with('success', '講義を更新しました');
    }

    public function destroy($id)
    {
        $course = \App\Models\Course::findOrFail($id);
        $course->delete();

        return redirect()->route('professor.courses.index')->with('success', '講義を削除しました');
    }
}
