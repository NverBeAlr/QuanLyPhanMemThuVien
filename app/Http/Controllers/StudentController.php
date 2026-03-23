<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('classes.major')->get();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = \App\Models\classes::with('major')->get();
        return view('student.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'email' => 'required|email|unique:students',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'status' => 'required|string',
        ]);
        
        $validated['password'] = bcrypt($validated['password']);
        Student::create($validated);
        return redirect()->route('student.index')->with('success', 'Sinh viên đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('classes.major');
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = \App\Models\classes::with('major')->get();
        return view('student.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'status' => 'required|string',
        ]);
        
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $student->update($validated);
        return redirect()->route('student.index')->with('success', 'Sinh viên đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Sinh viên đã được xóa thành công');
    }
}
