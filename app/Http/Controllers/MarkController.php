<?php

namespace App\Http\Controllers;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Assessment;


use Illuminate\Http\Request;

class MarkController extends Controller
{
    // Show all marks for a specific assessment
    public function index($assessment_id)
    {
        $assessment = Assessment::with('subject')->findOrFail($assessment_id);

        $students = $assessment->subject->students ?? collect();
    
        // Fetch marks where assessment_id matches
        $existingMarks = Mark::where('assessment_id', $assessment_id)
                            ->get()
                            ->keyBy('student_id'); // So we can do $existingMarks[$student->id]
    
        return view('marks.index', compact('assessment', 'students', 'existingMarks'));
    }


    // Show form to add mark for a student

    public function create($assessment_id)
{
    $assessment = Assessment::findOrFail($assessment_id);
    $subject = $assessment->subject;

    // Only students registered to this subject
    $students = $subject->students;

    return view('marks.create', compact('assessment', 'students'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $assessment_id)
    {
        $assessment = Assessment::findOrFail($assessment_id);
    
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'mark' => 'required|numeric|min:0|max:' . $assessment->percentage, 
        ]);
    
        // Prevent duplicate mark entry
        $existing = Mark::where('assessment_id', $assessment_id)
                        ->where('student_id', $request->student_id)
                        ->first();
    
        if ($existing) {
            return redirect()->back()->withErrors(['Mark already exists for this student and assessment.']);
        }
    
        Mark::create([
            'student_id' => $request->student_id,
            'assessment_id' => $assessment_id,
            'mark' => $request->mark,
        ]);
    
        return redirect()->route('mark.index', $assessment_id)->with('success', 'Mark added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('marks.show', compact('mark'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($assessment_id, $student_id)
    {
        $assessment = Assessment::findOrFail($assessment_id);
        $student = Student::findOrFail($student_id);
    
        $mark = Mark::where('assessment_id', $assessment_id)
                    ->where('student_id', $student_id)
                    ->firstOrFail();
    
        return view('marks.edit', compact('assessment', 'student', 'mark'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $assessment_id, $student_id)
    {
        $assessment = Assessment::findOrFail($assessment_id);
    
        $request->validate([
            'mark' => 'required|numeric|min:0|max:' . $assessment->percentage,
        ]);
    
        $mark = Mark::where('assessment_id', $assessment_id)
                    ->where('student_id', $student_id)
                    ->firstOrFail();
    
        $mark->update([
            'mark' => $request->mark,
        ]);
    
        return redirect()->route('mark.index', $assessment_id)->with('success', 'Mark updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($assessment_id, $student_id)
    {
        $mark = Mark::where('assessment_id', $assessment_id)
                    ->where('student_id', $student_id)
                    ->firstOrFail();
    
        $mark->delete();
    
        return redirect()->route('mark.index', $assessment_id)->with('success', 'Mark deleted successfully.');
    }
    
}
