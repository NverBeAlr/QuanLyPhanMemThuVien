<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $student = Auth::guard('student')->user();

            if (!$student->password_changed_at) {
                return redirect()->route('student.password.change');
            }

            return redirect()->route('student.borrow');
        }

        return back()->with('error','Sai email hoặc password');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
    
    public function showBorrow()
    {
        $student = Auth::guard('student')->user();
        if (!$student->password_changed_at) {
            return redirect()->route('student.password.change');
        }

        $books = Book::with('author', 'category')->where('available_copies', '>', 0)->get();
        return view('login_student.home', compact('books'));
    }

    public function showChangePassword()
    {
        $student = Auth::guard('student')->user();
        if ($student->password_changed_at) {
            return redirect()->route('student.borrow');
        }

        return view('login_student.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $student = Auth::guard('student')->user();
        $student->password = Hash::make($request->new_password);
        $student->password_changed_at = Carbon::now();
        $student->save();

        return redirect()->route('student.borrow')->with('success', 'Đổi mật khẩu thành công!');
    }

    public function borrow(Request $request)
    {
        $student = Auth::guard('student')->user();
        if (!$student->password_changed_at) {
            return redirect()->route('student.password.change');
        }

        $request->validate([
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
            'return_date' => 'required|date|after:today',
        ]);


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
    }

    public function showProfile()
    {
        $student = Auth::guard('student')->user();
        if (!$student->password_changed_at) {
            return redirect()->route('student.password.change');
        }

        return view('login_student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::guard('student')->user();
        if (!$student->password_changed_at) {
            return redirect()->route('student.password.change');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $student->update($request->only(['name', 'email', 'phone_number', 'address']));

        return redirect()->route('student.profile')->with('success', 'Thông tin đã được cập nhật!');
    }
}
