@extends('layouts.layout1')

@section('title', 'Subject List')

@section('content')
    <h1 class="h3 mb-4 text-dark">Subject List</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Subject Code</th>
                    <th>Name</th>
                    <th>Credit Hours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->subjectCode }}</td>
                    <td>{{ $subject->subjectName }}</td>
                    <td>{{ $subject->credit_hours }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-sm btn-warning text-white">
                                Edit
                            </a>
                            <form action="{{ route('subject.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Subject?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection