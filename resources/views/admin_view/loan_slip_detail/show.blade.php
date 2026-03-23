@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết phiếu mượn</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Chi tiết phiếu mượn #{{ $loanSlipDetail->id }}</h5>
            <p class="card-text"><strong>Phiếu mượn:</strong> {{ $loanSlipDetail->loanSlip->id ?? 'N/A' }}</p>
            <p class="card-text"><strong>Sách:</strong> {{ $loanSlipDetail->book->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Số tiền phí:</strong> {{ $loanSlipDetail->fee_amount }}</p>
            <p class="card-text"><strong>Trạng thái:</strong> {{ $loanSlipDetail->status }}</p>
        </div>
    </div>
    <a href="{{ route('loan_slip_detail.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('loan_slip_detail.edit', $loanSlipDetail->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection