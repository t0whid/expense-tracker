<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get(); // Fetch categories for the authenticated user
        return view('backend.categories.index', compact('categories')); // Pass data to the view
    }

    public function create()
    {
        return view('backend.categories.create'); // Return the create form view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        // Create category with authenticated user's ID
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        // Check if the category belongs to the authenticated user
        if ($category->user_id !== Auth::id()) {
            return redirect()->route('categories.index')->with('error', 'Unauthorized access.');
        }

        return view('backend.categories.edit', compact('category')); // Return the edit form view
    }

    public function update(Request $request, Category $category)
    {
        // Check if the category belongs to the authenticated user
        if ($category->user_id !== Auth::id()) {
            return redirect()->route('categories.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]); 

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function toggleStatus($id)
    {
        $category = Category::find($id);

        // Check if the category belongs to the authenticated user
        if ($category->user_id !== Auth::id()) {
            return redirect()->route('categories.index')->with('error', 'Unauthorized access.');
        }

        $category->status = !$category->status;
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Status updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if the category belongs to the authenticated user
        if ($category->user_id !== Auth::id()) {
            return redirect()->route('categories.index')->with('error', 'Unauthorized access.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
