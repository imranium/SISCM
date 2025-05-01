<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('access-lecturer-index')) {
            $data = Lecturer::paginate(5);
            return view('lecturers.index', compact('lecturers'));
        } else {
            abort(403, 'Sorry, you’re not allowed here!');
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lecturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|string|max:255',
            'staffId' => 'required|string|max:255|unique',
        ]);

        Lecturer::create([
            'name'=> $request->name,
            'staffId' => $request->staffId,
        ]);

        return redirect()->route('lecturers.index')->with('success', 'Lecturer created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer)
    {
        return view('lecturers.show', compact('lecturer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'staffId'=> 'required|string|max:255|unique',
        ]);

        $lecturer->update([
            'name' => $request->name,
            'studentId' => $request->staffId,
            'updated_at' => now(),
        ]);

        return redirect()->route('lecturers.index')
        ->withSuccess('Lecturer record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')
            ->withSuccess('Lecturers record deleted successfully.');  
    }
}
