@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Chuyên ngành</h2>
    <form action="{{ route('majors.update', $major->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $major->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $major->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Chuyên ngành</button>
        <a href="{{ route('majors.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection