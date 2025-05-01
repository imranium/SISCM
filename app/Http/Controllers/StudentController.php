<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate; 
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Subject;

class StudentController extends Controller
{
    public function index()
    {
        if (!Gate::allows('view-student')) {
            abort(403, 'Sorry, you’re not allowed here!');
        }

        $students = Student::with('subjects')->paginate(6);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        if (!Gate::allows('edit-student')) {
            abort(403, 'Sorry, you’re not allowed to create student records.');
        }

        $subjects = Subject::all();

        // Pass to the view
        return view('students.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('edit-student')) {
            abort(403, 'Sorry, you’re not allowed to store student records.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'studentId' => $request->studentId,
        ]);
        
        // Attach selected subjects (if any)
        if ($request->has('subject_ids')) {
            $student->subjects()->attach($request->subject_ids);
        }
        
        return redirect()->route('student.index')->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
    {
        if (!Gate::allows('view-student')) {
            abort(403, 'Sorry, you’re not allowed to view this student.');
        }

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        if (!Gate::allows('edit-student')) {
            abort(403, 'Sorry, you’re not allowed to edit student records.');
        }

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if (!Gate::allows('edit-student')) {
            abort(403, 'Sorry, you’re not allowed to update student records.');
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'studentId' => $request->studentId,
            'updated_at' => now(),
        ]);

        return redirect()->route('student.index')
            ->with('success', 'Student record updated successfully.');
    }

    public function destroy(Student $student)
    {
        if (!Gate::allows('delete-student')) {
            abort(403, 'Sorry, you’re not allowed to delete student records.');
        }

        $student->delete();
        return redirect()->route('student.index')
            ->with('success', 'Student record deleted successfully.');
    }
}
