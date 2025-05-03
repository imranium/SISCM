@extends('layouts.layout1')

@section('title', 'Marks for Assessment')

@section('content')
<div class="container">
    <h2 class="mb-3">Marks for: {{ $assessment->title }} ({{ ucfirst($assessment->type) }}, {{ $assessment->percentage }}%)</h2>
    <p><strong>Subject:</strong> {{ $assessment->subject->name }} ({{ $assessment->subject->subjectCode }})</p>
    <a href="{{ route('mark.create', $assessment->id) }}" class="btn btn-primary">
        + Add Mark
    </a>

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
                <th>Email</th>
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
                    <td>{{ $existingMarks[$student->id]->mark ?? '-' }}</td>
                    <td>
                        <a href="{{ route('mark.edit', [$assessment->id, $student->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('mark.destroy', [$assessment->id, $student->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this mark?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No students found for this subject.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('assessment.index', $assessment->subject_id) }}" class="btn btn-secondary mt-3">Back to Assessments</a>
</div>
@endsection
