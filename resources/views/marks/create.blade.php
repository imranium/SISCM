@extends('layouts.layout1')

@section('title', 'Add Marks for Assessment')

@section('content')
<div class="container">
    <h2>Enter Marks for: {{ $assessment->name }} ({{ ucfirst($assessment->type) }}, {{ $assessment->percentage }}%)</h2>
    <p><strong>Subject:</strong> {{ $assessment->subject->name }} ({{ $assessment->subject->subjectCode }})</p>

    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('marks.store', $assessment->id) }}" method="POST">
        @csrf

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Mark (0 - 100)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <input type="number" name="marks[{{ $student->id }}]" class="form-control" min="0" max="100" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save Marks</button>
        <a href="{{ route('assessment.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

