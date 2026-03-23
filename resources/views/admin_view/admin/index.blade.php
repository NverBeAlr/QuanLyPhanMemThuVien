@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Quản trị viên</h2>
    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Thêm Quản trị viên mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $index => $admin)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone_number ?? 'N/A' }}</td>
                <td>{{ $admin->role }}</td>
                <td>
                    <a href="{{ route('admin.show', $admin->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection