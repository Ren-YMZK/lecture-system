<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assignment;


class AssignmentController extends Controller
{
    public function index($courseId)
    {
        $course = \App\Models\Course::findOrFail($courseId);
        $assignments = $course->assignments;

        return view('professor.assignments.index', compact('course', 'assignments'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('professor.assignments.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'max_score' => 'required|integer|min:1',
        ]);

        Assignment::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'max_score' => $request->max_score,
        ]);

        return redirect()->route('professor.assignments.index', $request->course_id)
            ->with('success', '課題を追加しました');
    }

    public function edit($id)
    {
        $assignment = \App\Models\Assignment::findOrFail($id);
        return view('professor.assignments.edit', compact('assignment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'max_score' => 'required|integer|min:1',
        ]);

        $assignment = \App\Models\Assignment::findOrFail($id);
        $assignment->update($request->only(['title', 'description', 'deadline', 'max_score']));

        return redirect()->route('professor.assignments.index', $assignment->course_id)
            ->with('success', '課題を更新しました');
    }

    public function destroy($id)
    {
        $assignment = \App\Models\Assignment::findOrFail($id);
        $assignment->delete();

        return back()->with('success', '課題を削除しました');
    }
}
