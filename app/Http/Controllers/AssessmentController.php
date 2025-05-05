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
    public function index($subject_id)
    {
        $subject = Subject::with('assessments')->findOrFail($subject_id);

        $assessments = $subject->assessments()->paginate(10);

        return view('assessments.index', compact('subject', 'assessments'));

    }

    public function create($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);

        return view('assessments.create', compact('subject'));
    }

    // Store new assessment
    public function store(Request $request, $subject_id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:formative,summative',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);
    
        $subject = Subject::findOrFail($subject_id);
    
        // Get current total percentage for the same type of assessments
        $currentTotal = $subject->assessments()
            ->where('type', $validated['type'])
            ->sum('percentage');
    
        $maxLimit = $validated['type'] === 'formative' ? 60 : 40;
    
        if ($currentTotal + $validated['percentage'] > $maxLimit) {
            return back()->withErrors([
                'percentage' => "Total {$validated['type']} assessments for this subject cannot exceed {$maxLimit}%."
            ])->withInput();
        }
    
        $subject->assessments()->create($validated);
    
        return redirect()->route('assessment.index', $subject_id)
                         ->with('success', 'Assessment created successfully.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $assessment = Assessment::with('subject')->findOrFail($id);

        return view('assessments.show', compact('assessment'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    // Show edit form
    public function edit($id)
    {
        $assessment = Assessment::findOrFail($id);

        return view('assessments.edit', compact('assessment'));
    }

    // Update assessment
    public function update(Request $request, $id)
    {
        $assessment = Assessment::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:formative,summative',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $assessment->update($validated);

        return redirect()->route('assessments.index', $assessment->subject_id)
                         ->with('success', 'Assessment updated.');
    }

    // Delete assessment
    public function destroy($id)
    {
        $assessment = Assessment::findOrFail($id);

        $subject_id = $assessment->subject_id;

        $assessment->delete();

        return redirect()->route('assessments.index', $subject_id)
                         ->with('success', 'Assessment deleted.');
    }
}