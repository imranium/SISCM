@extends('layouts.layout1')

@section('title', 'Lecturer List')

@section('content')
    <h1 class="h3 mb-4 text-dark">Lecturer List</h1>

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
                    <th>Name</th>
                    <th>Staff ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $lecturer->id }}</td>
                    <td>{{ $lecturer->name }}</td>
                    <td>{{ $lecturer->staffId }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-sm btn-warning text-white">
                                Edit
                            </a>
                            <form action="{{ route('lecturer.destroy', $lecturer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lecturer?')">
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