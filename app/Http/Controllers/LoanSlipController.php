<?php

namespace App\Http\Controllers;

use App\Models\loanSlip;
use Illuminate\Http\Request;

class LoanSlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanSlips = loanSlip::with('admin', 'student', 'loanSlipDetails')->get();
        return view('loan_slips.index', compact('loanSlips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins = \App\Models\Admin::all();
        $students = \App\Models\Student::all();
        return view('loan_slips.create', compact('admins', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'student_id' => 'required|exists:students,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'return_date' => 'nullable|date|after:start_date',
            'total_books' => 'required|integer|min:0',
            'total_fee' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);
        
        loanSlip::create($validated);
        return redirect()->route('loan_slips.index')->with('success', 'Phiếu mượn đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(loanSlip $loanSlip)
    {
        $loanSlip->load('admin', 'student', 'loanSlipDetails.book');
        return view('loan_slips.show', compact('loanSlip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loanSlip $loanSlip)
    {
        $admins = \App\Models\Admin::all();
        $students = \App\Models\Student::all();
        return view('loan_slips.edit', compact('loanSlip', 'admins', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, loanSlip $loanSlip)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'student_id' => 'required|exists:students,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'return_date' => 'nullable|date|after:start_date',
            'total_books' => 'required|integer|min:0',
            'total_fee' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);
        
        $loanSlip->update($validated);
        return redirect()->route('loan_slips.index')->with('success', 'Phiếu mượn đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(loanSlip $loanSlip)
    {
        $loanSlip->delete();
        return redirect()->route('loan_slips.index')->with('success', 'Phiếu mượn đã được xóa thành công');
    }
}
