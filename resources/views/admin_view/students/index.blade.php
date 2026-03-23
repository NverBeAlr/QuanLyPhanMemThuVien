@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Sinh viên</h2>
    <a href="{{ route('student.create') }}" class="btn btn-primary mb-3">Thêm Sinh viên mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Lớp</th>
                <th>Chuyên ngành</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->classes->name ?? 'N/A' }}</td>
                <td>{{ $student->classes->major->name ?? 'N/A' }}</td>
                <td>{{ $student->phone_number ?? 'N/A' }}</td>
                <td>{{ $student->status }}</td>
                <td>
                    <a href="{{ route('student.show', $student->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
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