@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Phiếu mượn</h2>
    <a href="{{ route('loan_slip.create') }}" class="btn btn-primary mb-3">Thêm Phiếu mượn mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Quản trị viên</th>
                <th>Sinh viên</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Ngày trả</th>
                <th>Tổng số sách</th>
                <th>Tổng phí</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loanSlips as $index => $loanSlip)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $loanSlip->admin->name ?? 'N/A' }}</td>
                <td>{{ $loanSlip->student->name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($loanSlip->start_date)->format('d/m/Y') }}</td>
                <td>{{ $loanSlip->end_date ? \Carbon\Carbon::parse($loanSlip->end_date)->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $loanSlip->return_date ? \Carbon\Carbon::parse($loanSlip->return_date)->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $loanSlip->total_books }}</td>
                <td>{{ $loanSlip->total_fee }}</td>
                <td>{{ $loanSlip->status }}</td>
                <td>
                    <a href="{{ route('loan_slip.show', $loanSlip->id) }}" class="btn btn-info btn-sm">Xem</a>
                    <a href="{{ route('loan_slip.edit', $loanSlip->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('loan_slip.destroy', $loanSlip->id) }}" method="POST" style="display:inline;">
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