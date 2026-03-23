@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tạo Danh Mục Mới</h2>
    <form action="{{ route('catergories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
        <a href="{{ route('catergories.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection