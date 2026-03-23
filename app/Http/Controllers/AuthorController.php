<?php

namespace App\Http\Controllers;

use App\Models\author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = author::all();
        return view('Author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string',
        ]);
        
        author::create($validated);
        return redirect()->route('authors.index')->with('success', 'Tác giả đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(author $author)
    {
        return view('Author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        return view('Author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string',
        ]);
        
        $author->update($validated);
        return redirect()->route('authors.index')->with('success', 'Tác giả đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Tác giả đã được xóa thành công');
    }
}
