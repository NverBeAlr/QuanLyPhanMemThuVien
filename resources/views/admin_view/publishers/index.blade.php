@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Nhà xuất bản</h2>
    <a href="{{ route('publishers.create') }}" class="btn btn-primary mb-3">Thêm Nhà xuất bản mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publishers as $index => $publisher)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $publisher->name }}</td>
                <td>{{ $publisher->address ?? 'N/A' }}</td>
                <td>{{ $publisher->phone_number ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('publishers.show', $publisher->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection