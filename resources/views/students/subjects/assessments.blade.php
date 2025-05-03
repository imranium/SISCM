@extends('layouts.layout1')

@section('title', 'My Marks - ' . $subject->name)

@section('content')
<div class="container mt-4">
    <h2>Assessment Marks for {{ $subject->name }} ({{ $subject->subjectCode }})</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Assessment Title</th>
                <th>Type</th>
                <th>Weight (%)</th>
                <th>Your Mark</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assessments as $index => $assessment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $assessment->title }}</td>
                <td>{{ ucfirst($assessment->type) }}</td>
                <td>{{ $assessment->percentage }}%</td>
                <td>
                    {{ $marks[$assessment->id]->mark ?? 'Not Graded' }}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><strong>Total Carry Mark</strong></td>
                <td><strong>{{ number_format($totalCarryMark, 2) }}%</strong></td>
            </tr>
        </tfoot>
    </table>

    <a href="{{ route('student.subjects') }}" class="btn btn-secondary mt-3">Back to Subjects</a>
</div>
@endsection
