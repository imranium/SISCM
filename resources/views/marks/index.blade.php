@extends('layouts.layout1')

@section('title', 'Marks for Assessment')

@section('content')
<div class="container">
    <h2>Marks for: {{ $assessment->title }} ({{ ucfirst($assessment->type) }}, {{ $assessment->percentage }}%)</h2>
    <p><strong>Subject:</strong> {{ $assessment->subject->name }} ({{ $assessment->subject->subjectCode }})</p>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Mark</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->pivot->mark ?? '-' }}</td>
                    <td>
                        <a href="{{ route('marks.edit', [$assessment->id, $student->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No students assigned to this assessment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('assessment.index') }}" class="btn btn-secondary mt-3">Back to Assessments</a>
</div>
@endsection

