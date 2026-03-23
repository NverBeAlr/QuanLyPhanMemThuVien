@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách lớp học</h2>
    <a href="{{ route('classes.create') }}" class="btn btn-primary mb-3">Thêm Lớp Học Mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Chuyên ngành</th>
                <th>Năm học</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $index => $class)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $class->name }}</td>
                <td>{{ $class->major->name ?? 'N/A' }}</td>
                <td>{{ $class->course_year ?? 'N/A' }}</td>
                <td>{{ Str::limit($class->description, 50) ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('classes.show', $class->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
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