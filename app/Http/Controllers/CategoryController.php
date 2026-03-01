<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            // 'colocation_id' => 'required|exists:colocations,id',
        ]);

        $colocation->categories()->create([
            // 'colocation_id' => $colocation->id,
            'name' => $request->name,
        ]);
        // dd($request->all());

        return back()->with('success', 'Category created successfully.');
    }
}
