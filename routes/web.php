<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('books', App\Http\Controllers\BooksController::class);
Route::resource('authors', App\Http\Controllers\AuthorController::class);
Route::resource('publishers', App\Http\Controllers\PublisherController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('majors', App\Http\Controllers\MajorController::class);
Route::resource('classes', App\Http\Controllers\ClassesController::class);
Route::resource('admin', App\Http\Controllers\AdminController::class);
Route::resource('students', App\Http\Controllers\StudentController::class);
Route::resource('loan_slips', App\Http\Controllers\LoanSlipController::class);
Route::resource('loan_slip_detail', App\Http\Controllers\LoanSlipDetailController::class);