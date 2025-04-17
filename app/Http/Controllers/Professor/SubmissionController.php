<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;

class SubmissionController extends Controller
{
    public function index($assignmentId)
    {
        $assignment = Assignment::with('submissions.user')->findOrFail($assignmentId);
        $submissions = $assignment->submissions;

        return view('professor.submissions.index', compact('assignment', 'submissions'));
    }
}
