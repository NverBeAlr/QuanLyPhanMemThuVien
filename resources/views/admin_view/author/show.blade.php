@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết tác giả</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $author->name }}</h5>
            <p class="card-text"><strong>Ngày sinh:</strong> {{ $author->date_of_birth ? \Carbon\Carbon::parse($author->date_of_birth)->format('Y-m-d') : 'N/A' }}</p>
            <p class="card-text"><strong>Mô tả:</strong> {{ $author->description ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection