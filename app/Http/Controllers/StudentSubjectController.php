<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Mark;

class StudentSubjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            abort(403, 'User must be a student.');
        }

    
        $subjects = $student->subjects()->with('lecturer')->get();
        return view('students.subjects.index', compact('subjects'));
    }
    

    public function showAssessments($subject_id)
    {

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            abort(403, 'User must be a student.');
        }

        $subject = Subject::with('assessments')->findOrFail($subject_id);
        $assessments = $subject->assessments;

        $marks = Mark::where('student_id', $student->id)
                    ->whereIn('assessment_id', $assessments->pluck('id'))
                    ->get()
                    ->keyBy('assessment_id');

        // Calculate total carrymark
        $totalCarryMark = 0;
        foreach ($assessments as $assessment) {
            if (isset($marks[$assessment->id])) {
                $score = $marks[$assessment->id]->mark;
                $percentage = $assessment->percentage;
                $totalCarryMark += ($score / 100) * $percentage;
            }
        }

        return view('students.subjects.assessments', compact('subject', 'assessments', 'marks', 'totalCarryMark'));
    }
}


