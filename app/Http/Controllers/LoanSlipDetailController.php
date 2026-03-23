<?php

namespace App\Http\Controllers;

use App\Models\loanSlipDetail;
use Illuminate\Http\Request;

class LoanSlipDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanSlipDetails = loanSlipDetail::with('loanSlip', 'book')->get();
        return view('loan_slip_detail.index', compact('loanSlipDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loanSlips = \App\Models\loanSlip::all();
        $books = \App\Models\books::all();
        return view('loan_slip_detail.create', compact('loanSlips', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_slip_id' => 'required|exists:loan_slips,id',
            'book_id' => 'required|exists:books,id',
            'fee_amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);
        
        loanSlipDetail::create($validated);
        return redirect()->route('loan_slip_detail.index')->with('success', 'Chi tiết phiếu mượn đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(loanSlipDetail $loanSlipDetail)
    {
        $loanSlipDetail->load('loanSlip', 'book');
        return view('loan_slip_detail.show', compact('loanSlipDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loanSlipDetail $loanSlipDetail)
    {
        $loanSlips = \App\Models\loanSlip::all();
        $books = \App\Models\books::all();
        return view('loan_slip_detail.edit', compact('loanSlipDetail', 'loanSlips', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, loanSlipDetail $loanSlipDetail)
    {
        $validated = $request->validate([
            'loan_slip_id' => 'required|exists:loan_slips,id',
            'book_id' => 'required|exists:books,id',
            'fee_amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);
        
        $loanSlipDetail->update($validated);
        return redirect()->route('loan_slip_detail.index')->with('success', 'Chi tiết phiếu mượn đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loanSlipDetail $loanSlipDetail)
    {
        $loanSlipDetail->delete();
        return redirect()->route('loan_slip_detail.index')->with('success', 'Loan Slip Detail deleted successfully');
    }
}
