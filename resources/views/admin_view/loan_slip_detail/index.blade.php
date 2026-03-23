@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách chi tiết phiếu mượn</h2>
    <a href="{{ route('loan_slip_detail.create') }}" class="btn btn-primary mb-3">Thêm chi tiết phiếu mượn mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Phiếu mượn</th>
                <th>Sách</th>
                <th>Số tiền phí</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loanSlipDetails as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->loanSlip->id ?? 'N/A' }}</td>
                <td>{{ $detail->book->name ?? 'N/A' }}</td>
                <td>{{ $detail->fee_amount }}</td>
                <td>{{ $detail->status }}</td>
                <td>
                    <a href="{{ route('loan_slip_detail.show', $detail->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('loan_slip_detail.edit', $detail->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('loan_slip_detail.destroy', $detail->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection