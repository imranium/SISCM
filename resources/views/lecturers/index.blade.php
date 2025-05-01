@extends('layouts.layout1')

@section('title', 'Lecturer List')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-dark">Lecturer List</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('lecturers.create') }}" class="btn btn-primary">
            + Add Lecturer
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Staff ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lecturers as $lecturer)
                <tr>
                    <td>{{ $lecturer->id }}</td>
                    <td>{{ $lecturer->name }}</td>
                    <td>{{ $lecturer->staffId }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('lecturers.show', $lecturer->id) }}" class="btn btn-sm btn-info text-white">
                                View
                            </a>
                            <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="btn btn-sm btn-warning text-white">
                                Edit
                            </a>
                            <form action="{{ route('lecturers.destroy', $lecturer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lecturer?')">
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
        {{ $lecturers->links('pagination::bootstrap-5') }} 
    </div>
@endsection

