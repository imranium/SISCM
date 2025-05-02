<?php

namespace App\Http\Controllers;
use App\Models\Assessment;
use App\Models\Subject;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assessments = Assessment::with('subject')->paginate(10);
        return view('assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all(); // assuming lecturer can see all
        return view('assessments.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:formative,summative',
            'percentage' => 'required|integer|min:1|max:100',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Optional: add check for 60%/40% cap logic later

        Assessment::create($request->all());

        return redirect()->route('assessment.index')->with('success', 'Assessment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subjects = Subject::all();
        return view('assessment.edit', compact('assessment', 'subjects'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:formative,summative',
            'percentage' => 'required|integer|min:1|max:100',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Optional: add check for 60%/40% cap logic later

        $assessment = Assessment::findOrFail($id);
        $assessment->update($request->all());

        return redirect()->route('assessment.index')->with('success', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
       
        $assessment->delete();
        return redirect()->route('assessment.index')->with('success', 'Assessment deleted.');
    
    }
}
