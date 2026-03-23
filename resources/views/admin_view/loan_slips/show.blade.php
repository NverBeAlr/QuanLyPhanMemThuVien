@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết Phiếu mượn</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Phiếu mượn #{{ $loanSlip->id }}</h5>
            <p class="card-text"><strong>Quản trị viên:</strong> {{ $loanSlip->admin->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Sinh viên:</strong> {{ $loanSlip->student->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Ngày bắt đầu:</strong> {{ \Carbon\Carbon::parse($loanSlip->start_date)->format('d/m/Y') }}</p>
            <p class="card-text"><strong>Ngày kết thúc:</strong> {{ $loanSlip->end_date ? \Carbon\Carbon::parse($loanSlip->end_date)->format('d/m/Y') : 'N/A' }}</p>
            <p class="card-text"><strong>Ngày trả:</strong> {{ $loanSlip->return_date ? \Carbon\Carbon::parse($loanSlip->return_date)->format('d/m/Y') : 'N/A' }}</p>
            <p class="card-text"><strong>Tổng số sách:</strong> {{ $loanSlip->total_books }}</p>
            <p class="card-text"><strong>Tổng phí:</strong> {{ $loanSlip->total_fee }}</p>
            <p class="card-text"><strong>Trạng thái:</strong> 
                @if($loanSlip->status == 'borrowed')
                    Đã mượn
                @elseif($loanSlip->status == 'returned')
                    Đã trả
                @elseif($loanSlip->status == 'overdue')
                    Quá hạn
                @else
                    {{ $loanSlip->status }}
                @endif
            </p>
        </div>
    </div>
    @if($loanSlip->loanSlipDetails->count() > 0)
        <h4 class="mt-4">Chi tiết mượn</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sách</th>
                    <th>Số lượng</th>
                    <th>Phí</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loanSlip->loanSlipDetails as $detail)
                <tr>
                    <td>{{ $detail->book->name ?? 'N/A' }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->fee }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('loan_slip.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    <a href="{{ route('loan_slip.edit', $loanSlip->id) }}" class="btn btn-warning mt-3">Sửa</a>
</div>
@endsection