<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        // Fetch all expenses and eager load categories to reduce queries
        $expenses = Expense::with('category')->get();
        return view('backend.expenses.index', compact('expenses'));
    }

    public function create()
    {
        // Fetch all categories for the dropdown
        $categories = Category::all();
        return view('backend.expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'date' => 'nullable|date', // Ensure it's a valid date
            'note' => 'nullable|string',
            'expense_by' => 'nullable|string',
        ]);

        Expense::create([
            'name' => $request->name,
            'user_id' => auth()->id(), // Automatically sets the authenticated user's ID
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'date' => $request->date ? Carbon::parse($request->date) : null,
            'note' => $request->note,
            'expense_by' => $request->expense_by,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'date' => 'nullable|date', // Ensure it's a valid date
            'note' => 'nullable|string',
            'expense_by' => 'nullable|string',
        ]);

        $expense->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'date' => $request->date ? Carbon::parse($request->date) : null,
            'note' => $request->note,
            'expense_by' => $request->expense_by,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }
    public function edit(Expense $expense)
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('backend.expenses.edit', compact('expense', 'categories'));
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
