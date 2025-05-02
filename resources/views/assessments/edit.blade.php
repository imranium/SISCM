@extends('layouts.layout1')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Assessment</h1>

    <form action="{{ route('assessments.update', $assessment->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT') {{-- Use PUT method for updates --}}

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $assessment->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="quiz" {{ old('type', $assessment->type) == 'quiz' ? 'selected' : '' }}>Quiz</option>
                <option value="assignment" {{ old('type', $assessment->type) == 'assignment' ? 'selected' : '' }}>Assignment</option>
                <option value="exam" {{ old('type', $assessment->type) == 'exam' ? 'selected' : '' }}>Exam</option>
                <option value="project" {{ old('type', $assessment->type) == 'project' ? 'selected' : '' }}>Project</option>
                <option value="other" {{ old('type', $assessment->type) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage (%)</label>
            <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $assessment->percentage) }}" required>
            @error('percentage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Subject</label>
            <select class="form-select" id="subject_id" name="subject_id" required>
                <option value="" disabled>Select Subject</option>
                @foreach($subjects as $subject) {
                    <option value="{{ $subject->id }}" {{ old('subject_id', $assessment->subject_id) == $subject->id ? 'selected' : '' }}>
                        {{ $subject->subjectName }}
                    </option>
                @endforeach
            </select>
            @error('subject_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Assessment</button>
        <a href="{{ route('assessments.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
