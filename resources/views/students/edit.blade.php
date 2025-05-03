@extends('layouts.layout1')

@section('title', 'Edit Student')

@section('content')
    <h1 class="h3 mb-4 text-dark">Edit Student</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('student.update', $student->id)}}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT') {{-- methof for updating resources --}}

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Student ID</label>
            <input type="text" name="studentId" class="form-control" value="{{ old('studentId', $student->studentId) }}" required>
        </div>

        <div class="mb-3">
            <label for="subject_ids[" class="form-label">Subjects</label>
            <select name="subject_ids[]" class="form-select form-select-sm" aria-label=".form-select-sm example" multiple >
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">
                        {{ $subject->name }} ({{ $subject->subjectCode }})
                    </option>
                @endforeach
            </select>
        </div> 

        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="{{ route('student.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
@endsection
