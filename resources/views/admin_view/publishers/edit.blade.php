@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Nhà xuất bản</h2>
    <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $publisher->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $publisher->address) }}">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $publisher->phone_number) }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Nhà xuất bản</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection