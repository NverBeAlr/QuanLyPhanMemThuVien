@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Class</h2>
    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="major_id" class="form-label">Major</label>
            <select class="form-control" id="major_id" name="major_id" required>
                <option value="">Select Major</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                @endforeach
            </select>
            @error('major_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="course_year" class="form-label">Course Year</label>
            <input type="number" class="form-control" id="course_year" name="course_year" value="{{ old('course_year') }}" min="2000" max="{{ date('Y') + 1 }}">
            @error('course_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Class</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection