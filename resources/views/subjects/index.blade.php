@extends('layouts.layout1')

@section('title', 'Subject List')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-dark">Subject List</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">
            + Add Subject
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Subject Code</th>
                    <th>Name</th>
                    <th>Credit Hour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->subjectCode }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->credit_hours }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info text-white">
                                View
                            </a>
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning text-white">
                                Edit
                            </a>
                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Subject?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $subjects->links('pagination::bootstrap-5') }} 
    </div>
@endsection
