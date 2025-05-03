@extends('layouts.layout1')

@section('title', 'Add Mark')

@section('content')
<div class="container mt-4">
    <h2>Add Mark for Assessment: {{ $assessment->title }} ({{ $assessment->percentage }}%)</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mark.store', $assessment->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mark" class="form-label">Mark</label>
            <input type="number" class="form-control" name="mark" id="mark" required min="0" max="{{ $assessment->percentage }}">
            <small class="text-muted">Maximum: {{ $assessment->percentage }}</small>
        </div>

        <button type="submit" class="btn btn-success">Add Mark</button>
        <a href="{{ route('mark.index', $assessment->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
