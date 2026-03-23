@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết Quản trị viên</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $admin->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $admin->email }}</p>
            <p class="card-text"><strong>Số điện thoại:</strong> {{ $admin->phone_number ?? 'N/A' }}</p>
            <p class="card-text"><strong>Vai trò:</strong> {{ $admin->role }}</p>
        </div>
    </div>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection