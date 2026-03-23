@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách danh mục</h2>
    <a href="{{ route('catergories.create') }}" class="btn btn-primary mb-3">Thêm Danh Mục Mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ Str::limit($category->description, 50) ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('catergories.show', $category->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('catergories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('catergories.destroy', $category->id) }}" method="POST" style="display:inline;">
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