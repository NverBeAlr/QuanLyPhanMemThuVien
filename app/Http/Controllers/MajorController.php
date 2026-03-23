<?php

namespace App\Http\Controllers;

use App\Models\major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = major::all();
        return view('major.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        major::create($validated);
        return redirect()->route('majors.index')->with('success', 'Ngành học đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(major $major)
    {
        return view('major.show', compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(major $major)
    {
        return view('major.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, major $major)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $major->update($validated);
        return redirect()->route('majors.index')->with('success', 'Ngành học đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(major $major)
    {
        $major->delete();
        return redirect()->route('majors.index')->with('success', 'Major deleted successfully');
    }
}
