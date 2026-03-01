<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Colocation;

class CategoryController extends Controller
{
    public function create()
    {
        $colocations = Colocation::all();
        return view('categories.create', compact('colocations'));
    }

    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id,
        ]);

        return back()->with('success', 'Category created successfully.');
    }
}



