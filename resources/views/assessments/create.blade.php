@extends('layouts.layout1')

@section('content')
<div class="container">
    <h2>Create Assessment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assessment.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="subject_id" class="form-label">Subject</label>
            <select name="subject_id" id="subject_id" class="form-select" required>
                <option value="" disabled selected>Select a subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->subjectCode }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Assessment Name</label>
            <input type="text" name="title" class="form-control" placeholder="e.g., Quiz 1" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Assessment Type</label>
            <select name="type" class="form-select" required>
                <option value="" disabled selected>Select type</option>
                <option value="formative">Formative</option>
                <option value="summative">Summative</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage (%)</label>
            <input type="number" name="percentage" class="form-control" placeholder="e.g., 10" min="1" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Assessment</button>
    </form>
</div>
@endsection
