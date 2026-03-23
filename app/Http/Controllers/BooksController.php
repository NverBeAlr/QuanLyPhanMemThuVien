<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = books::with('author', 'publisher', 'category')->get();
        return view('admin_view.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = \App\Models\author::all();
        $publishers = \App\Models\publisher::all();
        $categories = \App\Models\category::all();
        return view('Book.create', compact('authors', 'publishers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id' => 'required|exists:categories,id',
            'total_quantity' => 'required|integer|min:0',
            'available_quantity' => 'required|integer|min:0',
            'year_published' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);
        
        books::create($validated);
        return redirect()->route('books.index')->with('success', 'Sách đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(books $books)
    {
        $books->load('author', 'publisher', 'category');
        return view('Book.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(books $books)
    {
        $authors = \App\Models\author::all();
        $publishers = \App\Models\publisher::all();
        $categories = \App\Models\category::all();
        return view('Book.edit', compact('books', 'authors', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, books $books)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id' => 'required|exists:categories,id',
            'total_quantity' => 'required|integer|min:0',
            'available_quantity' => 'required|integer|min:0',
            'year_published' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);
        
        $books->update($validated);
        return redirect()->route('books.index')->with('success', 'Sách đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(books $books)
    {
        $books->delete();
        return redirect()->route('books.index')->with('success', 'Sách đã được xóa thành công');
    }
}
