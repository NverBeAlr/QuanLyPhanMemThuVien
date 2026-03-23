@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết lớp học</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $classes->name }}</h5>
            <p class="card-text"><strong>Chuyên ngành:</strong> {{ $classes->major->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Năm học:</strong> {{ $classes->course_year ?? 'N/A' }}</p>
            <p class="card-text"><strong>Mô tả:</strong> {{ $classes->description ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('classes.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('classes.edit', $classes->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection