@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa tác giả</h2>
    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $author->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $author->date_of_birth) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $author->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Tác giả</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection