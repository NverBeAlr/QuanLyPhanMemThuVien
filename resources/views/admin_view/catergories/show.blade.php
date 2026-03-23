@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết danh mục</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <p class="card-text"><strong>Mô tả:</strong> {{ $category->description ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('catergories.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('catergories.edit', $category->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection