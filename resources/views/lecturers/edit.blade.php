@extends('layouts.layout1')

@section('title', 'Edit Lecturer')

@section('content')
    <h1 class="h3 mb-4 text-dark">Edit Lecturer</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('lecturer.update', $lecturer->id)}}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT') {{-- methof for updating resources --}}

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $lecturer->name) }}" required>
        </div>

    
        <div class="mb-3">
            <label class="form-label">Staff ID</label>
            <input type="text" name="staffId" class="form-control" value="{{ old('staffId', $lecturer->staffId) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Lecturer</button>
        <a href="{{ route('lecturer.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
@endsection
