<?php

namespace App\Http\Controllers;

use App\Models\publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = publisher::all();
        return view('publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);
        
        publisher::create($validated);
        return redirect()->route('publishers.index')->with('success', 'Nhà xuất bản đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(publisher $publisher)
    {
        return view('publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(publisher $publisher)
    {
        return view('publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, publisher $publisher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);
        
        $publisher->update($validated);
        return redirect()->route('publishers.index')->with('success', 'Nhà xuất bản đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('publishers.index')->with('success', 'Nhà xuất bản đã được xóa thành công');
    }
}
