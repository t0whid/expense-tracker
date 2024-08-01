<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeCategoryController extends Controller
{
    public function index()
    {
        $categories = IncomeCategory::where('user_id', Auth::id())->get(); // Fetch income categories for the authenticated user
        return view('backend.categories.income.index', compact('categories')); // Pass data to the view
    }

    public function create()
    {
        return view('backend.categories.income.create'); // Return the create form view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:income_categories',
            'description' => 'nullable|string',
        ]);

        // Create income category with authenticated user's ID
        IncomeCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('income-categories.index')->with('success', 'Income category created successfully.');
    }

    public function edit(IncomeCategory $incomeCategory)
    {
        // Check if the income category belongs to the authenticated user
        if ($incomeCategory->user_id !== Auth::id()) {
            return redirect()->route('income-categories.index')->with('error', 'Unauthorized access.');
        }

        return view('backend.categories.income.edit', compact('incomeCategory')); // Return the edit form view
    }

    public function update(Request $request, IncomeCategory $incomeCategory)
    {
        // Check if the income category belongs to the authenticated user
        if ($incomeCategory->user_id !== Auth::id()) {
            return redirect()->route('income-categories.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:income_categories,name,' . $incomeCategory->id,
            'description' => 'nullable|string',
        ]);

        $incomeCategory->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('income-categories.index')->with('success', 'Income category updated successfully.');
    }

    public function toggleStatus($id)
    {
        $incomeCategory = IncomeCategory::find($id);

        // Check if the income category belongs to the authenticated user
        if ($incomeCategory->user_id !== Auth::id()) {
            return redirect()->route('income-categories.index')->with('error', 'Unauthorized access.');
        }

        $incomeCategory->status = !$incomeCategory->status;
        $incomeCategory->save();

        return redirect()->route('income-categories.index')->with('success', 'Status updated successfully.');
    }

    public function destroy(IncomeCategory $incomeCategory)
    {
        // Check if the income category belongs to the authenticated user
        if ($incomeCategory->user_id !== Auth::id()) {
            return redirect()->route('income-categories.index')->with('error', 'Unauthorized access.');
        }

        $incomeCategory->delete();

        return redirect()->route('income-categories.index')->with('success', 'Income category deleted successfully.');
    }
}
