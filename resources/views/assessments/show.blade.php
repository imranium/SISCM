@extends('layouts.layout1')
@section('content')
<div class="container">
    <h2>Assessment Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $assessment->name }}</h5>
            <p class="card-text"><strong>Type:</strong> {{ ucfirst($assessment->type) }}</p>
            <p class="card-text"><strong>Percentage:</strong> {{ $assessment->percentage }}%</p>
            <p class="card-text"><strong>Subject:</strong> {{ $assessment->subject->name }} ({{ $assessment->subject->subjectCode }})</p>
        </div>
    </div>

    <a href="{{ route('assessment.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection

