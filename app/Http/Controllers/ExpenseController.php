<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Colocation;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Colocation $colocation)
    {
        $expenses = $colocation->expenses()->with('category', 'payer')->get();
        return view('expenses.index', compact('colocation', 'expenses'));
    }
    public function create(Colocation $colocation)
    {
        $categories = $colocation->categories;
        return view('expenses.create', compact('colocation', 'categories'));
    }

    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'title' => 'required|string|max:255',
            'expense_date' => 'required|date',
        ]);

        Expense::create([
            'colocation_id' => $colocation->id,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'title' => $request->title,
            'payer_id' => Auth::id(),
            'expense_date' => $request->expense_date,   
        ]);

        return back()->with('success', 'Expense created successfully.');
    }
}
