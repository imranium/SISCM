@extends('layouts.layout1')

@section('title', 'Edit Mark')

@section('content')
<div class="container mt-4">
    <h2>Edit Mark for: {{ $assessment->title }} ({{ $assessment->percentage }}%)</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mark.update', [$assessment->id, $student->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_name" class="form-label">Student</label>
            <input type="text" class="form-control" id="student_name" value="{{ $student->name }}" disabled>
        </div>

        <div class="mb-3">
            <label for="mark" class="form-label">Mark</label>
            <input type="number" class="form-control" name="mark" id="mark" required min="0" max="{{ $assessment->percentage }}" value="{{ $mark->mark }}">
            <small class="text-muted">Maximum: {{ $assessment->percentage }}</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Mark</button>
        <a href="{{ route('mark.index', $assessment->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
