@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết sách</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $books->name }}</h5>
            <p class="card-text"><strong>Tác giả:</strong> {{ $books->author->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Nhà xuất bản:</strong> {{ $books->publisher->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Thể loại:</strong> {{ $books->category->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Năm xuất bản:</strong> {{ $books->year_published ?? 'N/A' }}</p>
            <p class="card-text"><strong>Tổng số lượng:</strong> {{ $books->total_quantity }}</p>
            <p class="card-text"><strong>Số lượng có sẵn:</strong> {{ $books->available_quantity }}</p>
            <p class="card-text"><strong>Trạng thái:</strong> {{ $books->status }}</p>
            <p class="card-text"><strong>Mô tả:</strong> {{ $books->description ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('books.edit', $books->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection