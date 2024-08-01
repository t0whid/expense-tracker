<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::with('category')->get();
        return view('backend.incomes.index', compact('incomes'));
    }

    public function create()
    {
        $categories = IncomeCategory::where('user_id', Auth::id())->get(); // Fetch categories for the authenticated user
        return view('backend.incomes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'date' => 'nullable|date',
            'income_category_id' => 'required|exists:income_categories,id',
        ]);

        Income::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'note' => $request->note,
            'date' => $request->date ? Carbon::parse($request->date) : null,
            'income_category_id' => $request->income_category_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully.');
    }

    public function edit(Income $income)
    {
        if ($income->user_id !== Auth::id()) {
            return redirect()->route('incomes.index')->with('error', 'Unauthorized access.');
        }

        $categories = IncomeCategory::where('user_id', Auth::id())->get(); // Fetch categories for the authenticated user
        return view('backend.incomes.edit', compact('income', 'categories'));
    }

    public function update(Request $request, Income $income)
    {
        if ($income->user_id !== Auth::id()) {
            return redirect()->route('incomes.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'date' => 'nullable|date',
            'income_category_id' => 'required|exists:income_categories,id',
        ]);

        $income->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'note' => $request->note,
            'date' => $request->date,
            'income_category_id' => $request->income_category_id,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully.');
    }

    public function destroy(Income $income)
    {
        if ($income->user_id !== Auth::id()) {
            return redirect()->route('incomes.index')->with('error', 'Unauthorized access.');
        }

        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully.');
    }
}

