@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Chuyên ngành mới</h2>
    <form action="{{ route('majors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Chuyên ngành</button>
        <a href="{{ route('majors.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection