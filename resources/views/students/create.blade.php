@extends('layouts.layout1')

@section('title', 'Add Student')

@section('content')
    <h1 class="h3 mb-4 text-dark">Add New Student</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="studentId" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="studentId" name="studentId" required>
        </div>

        <div class="mb-3">
            <label for="ssubject_ids[" class="form-label">Subjects</label>
            <select name="subject_ids[]" class="form-select form-select-sm" aria-label=".form-select-sm example" multiple >
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">
                        {{ $subject->name }} ({{ $subject->subjectCode }})
                    </option>
                @endforeach
            </select>
        </div> 
        
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>

        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
@endsection