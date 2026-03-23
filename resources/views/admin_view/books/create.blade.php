@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tạo sách mới</h2>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="author_id" class="form-label">Tác giả</label>
            <select class="form-control" id="author_id" name="author_id" required>
                <option value="">Chọn tác giả</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Nhà xuất bản</label>
            <select class="form-control" id="publisher_id" name="publisher_id" required>
                <option value="">Chọn nhà xuất bản</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Thể loại</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Chọn thể loại</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="total_quantity" class="form-label">Tổng số lượng</label>
            <input type="number" class="form-control" id="total_quantity" name="total_quantity" required min="0">
        </div>
        <div class="mb-3">
            <label for="available_quantity" class="form-label">Số lượng có sẵn</label>
            <input type="number" class="form-control" id="available_quantity" name="available_quantity" required min="0">
        </div>
        <div class="mb-3">
            <label for="year_published" class="form-label">Năm xuất bản</label>
            <input type="number" class="form-control" id="year_published" name="year_published" min="1000" max="{{ date('Y') + 1 }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="available">Có sẵn</option>
                <option value="unavailable">Không có sẵn</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tạo sách</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection