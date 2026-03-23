@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách tác giả</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Thêm Tác giả Mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $index => $author)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->date_of_birth ? \Carbon\Carbon::parse($author->date_of_birth)->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ Str::limit($author->description, 50) ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
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