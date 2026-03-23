@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Sửa Phiếu mượn</h2>
    <form action="{{ route('loan_slip.update', $loanSlip->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="admin_id" class="form-label">Quản trị viên</label>
            <select class="form-control" id="admin_id" name="admin_id" required>
                <option value="">Chọn Quản trị viên</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}" {{ old('admin_id', $loanSlip->admin_id) == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                @endforeach
            </select>
            @error('admin_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="student_id" class="form-label">Sinh viên</label>
            <select class="form-control" id="student_id" name="student_id" required>
                <option value="">Chọn Sinh viên</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $loanSlip->student_id) == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $loanSlip->start_date) }}" required>
            @error('start_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Ngày kết thúc</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $loanSlip->end_date) }}">
            @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="return_date" class="form-label">Ngày trả</label>
            <input type="date" class="form-control" id="return_date" name="return_date" value="{{ old('return_date', $loanSlip->return_date) }}">
            @error('return_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="total_books" class="form-label">Tổng số sách</label>
            <input type="number" class="form-control" id="total_books" name="total_books" value="{{ old('total_books', $loanSlip->total_books) }}" min="0" required>
            @error('total_books')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="total_fee" class="form-label">Tổng phí</label>
            <input type="number" step="0.01" class="form-control" id="total_fee" name="total_fee" value="{{ old('total_fee', $loanSlip->total_fee) }}" min="0" required>
            @error('total_fee')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="borrowed" {{ old('status', $loanSlip->status) == 'borrowed' ? 'selected' : '' }}>Đã mượn</option>
                <option value="returned" {{ old('status', $loanSlip->status) == 'returned' ? 'selected' : '' }}>Đã trả</option>
                <option value="overdue" {{ old('status', $loanSlip->status) == 'overdue' ? 'selected' : '' }}>Quá hạn</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Phiếu mượn</button>
        <a href="{{ route('loan_slip.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection