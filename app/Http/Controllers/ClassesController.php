<?php

namespace App\Http\Controllers;

use App\Models\classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = classes::with('major')->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = \App\Models\major::all();
        return view('classes.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'course_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);
        
        classes::create($validated);
        return redirect()->route('classes.index')->with('success', 'Lớp đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(classes $classes)
    {
        $classes->load('major');
        return view('classes.show', compact('classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classes $classes)
    {
        $majors = major::all();
        return view('classes.edit', compact('classes', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, classes $classes)
    {
        $validated = $request->validate([
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'course_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);
        
        $classes->update($validated);
        return redirect()->route('classes.index')->with('success', 'Lớp đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(classes $classes)
    {
        $classes->delete();
        return redirect()->route('classes.index')->with('success', 'Lớp đã được xóa thành công');
    }
}
