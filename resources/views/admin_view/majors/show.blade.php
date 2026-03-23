@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết Chuyên ngành</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $major->name }}</h5>
            <p class="card-text"><strong>Mô tả:</strong> {{ $major->description ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('majors.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-warning mt-3">Chỉnh sửa</a>
</div>
@endsection