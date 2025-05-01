@extends('layouts.layout1')

@section('title', 'Edit Subject')

@section('content')
    <h1 class="h3 mb-4 text-dark">Edit Subject</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('subjects.update', $subject->id)}}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT') {{-- methof for updating resources --}}

        <div class="mb-3">
            <label class="form-label">Subject Code</label>
            <input type="text" name="subjectCode" class="form-control" value="{{ old('subjectCode', $subject->subjectCode) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="email" name="name" class="form-control" value="{{ old('name', $Subject->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Credit Hours</label>
            <input type="text" name="credit_hours" class="form-control" value="{{ old('credit_hours', $Subject->credit_hours) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Subject</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
@endsection
