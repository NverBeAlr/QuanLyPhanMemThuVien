@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết Sinh viên</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $student->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $student->email }}</p>
            <p class="card-text"><strong>Lớp:</strong> {{ $student->classes->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Chuyên ngành:</strong> {{ $student->classes->major->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Số điện thoại:</strong> {{ $student->phone_number ?? 'N/A' }}</p>
            <p class="card-text"><strong>Địa chỉ:</strong> {{ $student->address ?? 'N/A' }}</p>
            <p class="card-text"><strong>Ngày sinh:</strong> {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') : 'N/A' }}</p>
            <p class="card-text"><strong>Giới tính:</strong> {{ $student->gender ?? 'N/A' }}</p>
            <p class="card-text"><strong>Trạng thái:</strong> {{ $student->status }}</p>
        </div>
    </div>
    <a href="{{ route('student.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection