@extends('layouts.layout1')

@section('title', 'Add Subject')

@section('content')
    <h1 class="h3 mb-4 text-dark">Add New Subject</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Subject Code</label>
            <input type="text" class="form-control" id="subjectCode" name="subjectCode" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Name</label>
            <input type="email" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="SubjectId" class="form-label">Credit Hours</label>
            <input type="text" class="form-control" id="credit_hours" name="credit_hours" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>
@endsection