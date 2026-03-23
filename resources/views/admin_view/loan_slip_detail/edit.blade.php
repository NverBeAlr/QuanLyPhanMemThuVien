@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Sửa chi tiết phiếu mượn</h2>
    <form action="{{ route('loan_slip_detail.update', $loanSlipDetail->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="loan_slip_id" class="form-label">Phiếu mượn</label>
            <select class="form-control" id="loan_slip_id" name="loan_slip_id" required>
                <option value="">Chọn phiếu mượn</option>
                @foreach($loanSlips as $loanSlip)
                    <option value="{{ $loanSlip->id }}" {{ old('loan_slip_id', $loanSlipDetail->loan_slip_id) == $loanSlip->id ? 'selected' : '' }}>Phiếu mượn #{{ $loanSlip->id }}</option>
                @endforeach
            </select>
            @error('loan_slip_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="book_id" class="form-label">Sách</label>
            <select class="form-control" id="book_id" name="book_id" required>
                <option value="">Chọn sách</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id', $loanSlipDetail->book_id) == $book->id ? 'selected' : '' }}>{{ $book->name }}</option>
                @endforeach
            </select>
            @error('book_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fee_amount" class="form-label">Số tiền phí</label>
            <input type="number" step="0.01" class="form-control" id="fee_amount" name="fee_amount" value="{{ old('fee_amount', $loanSlipDetail->fee_amount) }}" min="0" required>
            @error('fee_amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="borrowed" {{ old('status', $loanSlipDetail->status) == 'borrowed' ? 'selected' : '' }}>Đã mượn</option>
                <option value="returned" {{ old('status', $loanSlipDetail->status) == 'returned' ? 'selected' : '' }}>Đã trả</option>
                <option value="overdue" {{ old('status', $loanSlipDetail->status) == 'overdue' ? 'selected' : '' }}>Quá hạn</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật chi tiết phiếu mượn</button>
        <a href="{{ route('loan_slip_detail.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection