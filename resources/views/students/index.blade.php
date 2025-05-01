@extends('layouts.layout1')

@section('title', 'Student List')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4 text-dark">Student List</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Show "Add Student" button only to Admin and Lecturer -->
    @can('edit-student')
    <div class="mb-3">
        <a href="{{ route('student.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>
    @endcan

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Student ID</th>
                    <th>Subjects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->studentId }}</td>
                    <td>
                        @if($student->subjects->isNotEmpty())
                            <ul class="mb-0">
                                @foreach($student->subjects as $subject)
                                    <li>{{ $subject->name }} ({{ $subject->subjectCode }})</li>
                                @endforeach
                            </ul>
                        @else
                            <em>No subjects assigned</em>
                        @endif
                    </td>
                    <td>
                        <!-- View Details: All roles -->
                        @can('view-student')
                            <a href="{{ route('student.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                        @endcan

                        <!-- Edit: Admin & Lecturer -->
                        @can('edit-student')
                            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan

                        <!-- Delete: Admin only -->
                        @can('delete-student')
                            <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $students->links('pagination::bootstrap-5') }} 
    </div>
</div>
@endsection
