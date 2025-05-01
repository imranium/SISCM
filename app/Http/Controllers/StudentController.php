<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate; 
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('edit-student')) {
            abort(403, 'Sorry, you’re not allowed here!');
        }
        //$students = Student::all(); // Retrieve all students from the database
        $students = Student::paginate(6); // Retrieve all students from the database with pagination
        return view('students.index', compact('students')); // Pass the students data to the view

    
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        // Create and save student
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'studentId' => $request->studentId,
        ]);

        // Redirect with success message
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
/*         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);
        // Update student details
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'studentId' => $request->studentId,
        ]);
        // Redirect with success message
        return redirect()->route('students.index')
            ->withSuccess('Student record updated successfully.'); */

            if(!Gate::allows('edit-student')) {
                abort(403, 'Sorry, you’re not allowed here!');
            }

            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'studentId' => $request->studentId,
                'updated_at' => now(),
            ]);

            return redirect()->route('students.index')
                ->withSuccess('Student record updated successfully.');
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {

        if(!Gate::allows('delete-student')) {
            abort(403, 'Sorry, you’re not allowed here!');
        }
        $student->delete();
        return redirect()->route('students.index')
            ->withSuccess('Student record deleted successfully.');   
             
    }
}
