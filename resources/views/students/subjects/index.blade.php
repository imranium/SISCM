@extends('layouts.layout1')

@section('title', 'My Subjects')

@section('content')
<div class="container mt-4">
    <h2>Subjects You Are Enrolled In</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Lecturer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $index => $subject)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $subject->subjectCode }}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->lecturer->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('student.subject.assessments', $subject->id) }}" class="btn btn-primary btn-sm">View Assessments</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
