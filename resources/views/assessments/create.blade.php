@extends('layouts.layout1')

@section('title', 'Create Assessment')

@section('content')
<div class="container mt-4">
    <h2>Create New Assessment for {{ $subject->name }} ({{ $subject->subjectCode }})</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assessment.store', $subject->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Assessment Title</label>
            <input type="text" name="title" class="form-control" id="title" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Assessment Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">-- Select Type --</option>
                <option value="formative" {{ old('type') == 'formative' ? 'selected' : '' }}>Formative</option>
                <option value="summative" {{ old('type') == 'summative' ? 'selected' : '' }}>Summative</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage (%)</label>
            <input type="number" name="percentage" class="form-control" id="percentage" required min="0" max="100" value="{{ old('percentage') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Assessment</button>
        <a href="{{ route('assessment.index', $subject->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
