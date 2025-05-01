<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(6); // Retrieve all subjects from the database with pagination
        return view('subjects.index', compact('subjects')); // Pass the subjects data to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'subjectCode' => 'required|string|max:255|unique:subjects',
            'subjectName' => 'required|string|max:255',
            'credit_hours' => 'required|integer|min:1',
            //'lecturer_id' => 'nullable|exists:lecturers,id', // Assuming you have a lecturers table
        ]);

        Subject::create([
            'subjectCode' => $request->subjectCode,
            'subjectName' => $request->subjectName,
            'credit_hours' => $request->credit_hours,
            //'lecturer_id' => $request->lecturer_id,
        ]);

        return redirect()->route('subject.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        // You might need to pass lecturers for the dropdown in the edit form
        //$lecturers = \App\Models\Lecturer::all();
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        // Validation
        $request->validate([
            'subjectCode' => 'required|string|max:255|unique:subjects,subjectCode,' . $subject->id,
            'subjectName' => 'required|string|max:255',
            'credit_hours' => 'required|integer|min:1',
            //'lecturer_id' => 'nullable|exists:lecturers,id',
        ]);

        $subject->update([
            'subjectCode' => $request->subjectCode,
            'subjectName' => $request->subjectName,
            'credit_hours' => $request->credit_hours,
            //'lecturer_id' => $request->lecturer_id,
            'updated_at' => now(),
        ]);

        return redirect()->route('subject.index')
            ->with('success', 'Subject record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')
            ->with('success', 'Subject record deleted successfully.');
    }
}