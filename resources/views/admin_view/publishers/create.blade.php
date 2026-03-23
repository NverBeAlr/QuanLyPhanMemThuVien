@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Nhà xuất bản mới</h2>
    <form action="{{ route('publishers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Nhà xuất bản</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection