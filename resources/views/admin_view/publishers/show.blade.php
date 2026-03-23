@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết Nhà xuất bản</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $publisher->name }}</h5>
            <p class="card-text"><strong>Địa chỉ:</strong> {{ $publisher->address ?? 'N/A' }}</p>
            <p class="card-text"><strong>Số điện thoại:</strong> {{ $publisher->phone_number ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('publishers.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning mt-3">Chỉnh sửa</a>
</div>
@endsection