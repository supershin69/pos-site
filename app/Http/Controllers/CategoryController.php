<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category Controller
    public function list() {

        //dd(request('searchKey'));
        $categories = Category::when(request('searchKey'), function ($query) {
            $query->where('name', 'like', '%'.strtolower(request('searchKey')).'%');
        })
                                ->orderByDesc('created_at')->paginate(10);
        return view('admin.category.list')->with(['categories' => $categories]);
    }

    // Category Create
    public function create(Request $request) {
        //dd($request->toArray());

        $this->validateRequest($request);
        $name = $request->categoryName;
        Category::create([
            'name' => $name,
        ]);

        return back()->with('message', 'Category successfully created.');

    }

    // Category Delete
    public function delete(Request $request, $id) {
        $category = Category::find($id);
        $category->delete();    
        return back();
    }

    // Category Edit Page
    public function edit(Request $request, $id) {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    // Category Update
    public function update(Request $request, $id) {
        $category = Category::find($id);

        if($request->categoryName == $category->name) {
            return to_route('CategoryList')->with('message', 'No changes were made.');
        }

        $this->validateRequest($request);

        

        $name = $request->categoryName;
        $category->update([
            'name' => $name,
        ]);

        return to_route('CategoryList')->with('message', 'Category successfully updated.');
    }

    // Validate Request Function
    public function validateRequest(Request $request) {
        $request->validate([
            'categoryName' => 'required|unique:categories,name',
        ]);
    }
}
