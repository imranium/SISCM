@extends('layouts.layout1')

@section('title', 'Assessment List')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-dark">Assessment List</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('assessment.create') }}" class="btn btn-primary">
            + Add Assessment
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Percentage (%)</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assessments as $index => $assessment)
                    <tr>
                        <td>{{ $index + $assessments->firstItem() }}</td>
                        <td>{{ $assessment->title }}</td>
                        <td>{{ ucfirst($assessment->type) }}</td>
                        <td>{{ $assessment->percentage }}</td>
                        <td>{{ $assessment->subject->subjectCode ?? '-' }}</td>
                        <td>
                            <a href="{{ route('assessment.show', $assessment->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('assessment.edit', $assessment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('assessment.destroy', $assessment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this assessment?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $assessments->links('pagination::bootstrap-5') }} 
    </div>
@endsection
