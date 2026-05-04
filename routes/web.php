<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\LoanSlipController;
use App\Http\Controllers\LoanSlipDetailController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admins', AdminController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('classes',ClassesController::class );
    Route::resource('students', StudentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('publishers', PublisherController::class);
    Route::resource('books', BookController::class);
    Route::resource('loan_slips', LoanSlipController::class);
    Route::resource('loan_slip_details', LoanSlipDetailController::class);
});

Route::get('admin/login', [AdminAuthController::class,'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class,'login'])->name('admin.login.post');
Route::post('admin/logout', [AdminAuthController::class,'logout'])->name('admin.logout');

// Student auth routes
Route::get('student/login', [StudentAuthController::class,'showLogin'])->name('student.login');
Route::post('student/login', [StudentAuthController::class,'login'])->name('student.login.post');
Route::post('student/logout', [StudentAuthController::class,'logout'])->name('student.logout');

// Student borrow and password routes
Route::middleware('auth:student')->group(function () {
    Route::get('student/password/change', [StudentAuthController::class, 'showChangePassword'])->name('student.password.change');
    Route::post('student/password/change', [StudentAuthController::class, 'changePassword'])->name('student.password.update');
    Route::get('student/profile', [StudentAuthController::class, 'showProfile'])->name('student.profile');
    Route::post('student/profile', [StudentAuthController::class, 'updateProfile'])->name('student.profile.update');
    Route::get('student/borrow', [StudentAuthController::class, 'showBorrow'])->name('student.borrow');
    Route::post('student/borrow', [StudentAuthController::class, 'borrow'])->name('student.borrow.submit');
});