<?php

namespace App\Http\Controllers;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Assessment;


use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all marks from the database
        $marks = Mark::with(['student', 'assessment'])->paginate(6); // Assuming you have a Mark model
        
        // Return the view with marks data
        return view('marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all students and assessments for the form
        $students = Student::all(); // Assuming you have a Student model
        $assessments = Assessment::all(); // Assuming you have an Assessment model

        // Return the view with students and assessments data
        return view('marks.create', compact('students', 'assessments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'assessment_id' => 'required|exists:assessments,id',
            'mark' => 'required|numeric|min:0|max:100', // Assuming marks are out of 100
        ]);

        // Create a new mark record
        Mark::create([
            'student_id' => $request->student_id,
            'assessment_id' => $request->assessment_id,
            'mark' => $request->mark,
        ]);

        return redirect()->route('mark.index')->with('success', 'Mark created successfully.');
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
    public function edit(string $id)
    {
        $students = Student::all(); 
        $assessments = Assessment::all(); // Assuming you have an Assessment model

        return view('marks.edit', compact('mark', 'students', 'assessments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'assessment_id' => 'required|exists:assessments,id',
            'mark' => 'required|numeric|min:0|max:100', // Assuming marks are out of 100
        ]);

        // Update the mark record
        $mark = Mark::findOrFail($id);
        $mark->update([
            $request->all()
        ]);

        return redirect()->route('mark.index')->with('success', 'Mark updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mark $mark)
    {

        $mark->delete();

        return redirect()->route('mark.index')->with('success', 'Mark deleted successfully.');
    }
}
