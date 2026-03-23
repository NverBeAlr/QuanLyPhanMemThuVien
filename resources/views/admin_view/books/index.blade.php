@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách sách</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Thêm sách mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Tác giả</th>
                <th>Nhà xuất bản</th>
                <th>Thể loại</th>
                <th>Năm xuất bản</th>
                <th>Tổng số lượng</th>
                <th>Số lượng có sẵn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->author->name ?? 'N/A' }}</td>
                <td>{{ $book->publisher->name ?? 'N/A' }}</td>
                <td>{{ $book->category->name ?? 'N/A' }}</td>
                <td>{{ $book->year_published ?? 'N/A' }}</td>
                <td>{{ $book->total_quantity }}</td>
                <td>{{ $book->available_quantity }}</td>
                <td>{{ $book->status }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
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