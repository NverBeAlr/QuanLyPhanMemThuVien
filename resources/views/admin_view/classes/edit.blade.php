@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa lớp học</h2>
    <form action="{{ route('classes.update', $classes->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $classes->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="major_id" class="form-label">Chuyên ngành</label>
            <select class="form-control" id="major_id" name="major_id" required>
                <option value="">Select Major</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ old('major_id', $classes->major_id) == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                @endforeach
            </select>
            @error('major_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="course_year" class="form-label">Năm học</label>
            <input type="number" class="form-control" id="course_year" name="course_year" value="{{ old('course_year', $classes->course_year) }}" min="2000" max="{{ date('Y') + 1 }}">
            @error('course_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $classes->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Lớp học</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection