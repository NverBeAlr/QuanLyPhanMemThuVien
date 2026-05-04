<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students',
            'password' => 'nullable|string|min:6',
            'phone_number' => 'nullable|max:20',
            'class_id' => 'required'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->input('password', '123456'));

        Student::create($data);

        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        $classes = Classes::all();
        return view('students.edit', compact('student','classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|max:20'
        ]);

        $student->update($request->all());

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}