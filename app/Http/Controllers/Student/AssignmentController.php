<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Submission;


class AssignmentController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $assignments = $course->assignments;

        return view('student.assignments.index', compact('course', 'assignments'));
    }

    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);

        $submission = Submission::where('assignment_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, $assignmentId)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'comment' => 'nullable|string',
        ]);

        // ✅ ファイルを public/submissions に保存
        $storedPath = $request->file('file')->store('public/submissions');


        // ✅ 'public/' を取り除いて Web からアクセスできる形式に
        $filePath = str_replace('public/', '', $storedPath);

        // ✅ DB に保存
        Submission::create([
            'assignment_id' => $assignmentId,
            'user_id' => Auth::id(),
            'file_path' => $filePath, // ← submissions/xxx.txt
            'comment' => $request->comment,
            'submitted_at' => now(),
        ]);

        return redirect()->route('student.assignments.show', $assignmentId)
            ->with('success', '課題を提出しました！');
    }
}
