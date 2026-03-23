@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Chuyên ngành</h2>
    <a href="{{ route('majors.create') }}" class="btn btn-primary mb-3">Thêm Chuyên ngành mới</a>
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
            @foreach($majors as $index => $major)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $major->name }}</td>
                <td>{{ Str::limit($major->description, 50) ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('majors.show', $major->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('majors.destroy', $major->id) }}" method="POST" style="display:inline;">
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