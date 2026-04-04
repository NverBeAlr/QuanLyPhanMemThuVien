<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\LoanSlip;
use App\Models\LoanSlipDetail;
use Carbon\Carbon;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        return view('login_student.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');

        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->route('student.borrow');
        }

        return back()->with('error','Sai email hoặc password');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('login_student.login');
    }
    public function showBorrow()
    {
        $books = Book::with('author', 'category')->where('available_copies', '>', 0)->get();
        return view('login_student.layout', compact('books'));
    }

    public function borrow(Request $request)
    {
        $request->validate([
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
            'return_date' => 'required|date|after:today',
        ]);

        $student = Auth::guard('student')->user();

        // Create loan slip
        $loanSlip = LoanSlip::create([
            'student_id' => $student->id,
            'start_date' => Carbon::now(),
            'end_date' => $request->return_date,
            'status' => 'borrowed',
            'total_books' => count($request->book_ids),
        ]);

        // Create loan slip details and update book copies
        foreach ($request->book_ids as $bookId) {
            $book = Book::find($bookId);
            if ($book && $book->available_copies > 0) {
                LoanSlipDetail::create([
                    'loan_slip_id' => $loanSlip->id,
                    'book_id' => $bookId,
                    'fee_amount' => 0,
                    'status' => 'borrowed',
                ]);
                $book->decrement('available_copies');
            }
        }

        return redirect()->route('student.borrow')->with('success', 'Mượn sách thành công!');
    }}