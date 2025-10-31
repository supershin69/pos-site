<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category Controller
    public function list() {
        return view('admin.category.list');
    }

    // Category Create
    public function create(Request $request) {
        //dd($request->toArray());
        $request->validate([
            'categoryName' => 'required|unique:categories,name',
        ]);
        $name = $request->categoryName;
        Category::create([
            'name' => $name,
        ]);

        return back()->with('message', 'Category successfully inserted.');
        
    }
}
