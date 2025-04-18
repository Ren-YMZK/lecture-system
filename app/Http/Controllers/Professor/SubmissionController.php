<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function index($assignmentId)
    {
        $assignment = Assignment::with('submissions.user')->findOrFail($assignmentId);
        $submissions = $assignment->submissions;

        return view('professor.submissions.index', compact('assignment', 'submissions'));
    }

    public function score(Request $request, $submissionId)
    {
        $submission = Submission::with('assignment')->findOrFail($submissionId);
        $maxScore = $submission->assignment->max_score;

        $request->validate([
            'score' => ['required', 'integer', 'min:0', 'max:' . $maxScore],
        ]);

        $submission->score = $request->score;
        $submission->save();

        return back()->with('success', '点数を保存しました');
    }
}
