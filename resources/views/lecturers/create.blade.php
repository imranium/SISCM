@extends('layouts.layout1')

@section('title', 'Add Lecturer')

@section('content')
    <h1 class="h3 mb-4 text-dark">Add New lecturer</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lecturer.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="staffId" class="form-label">Staff ID</label>
            <input type="text" class="form-control" id="staffId" name="staffId" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Lecturer</button>
    </form>
@endsection