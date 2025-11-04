<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Product List Page
    public function list()
    {
        $products = Product::orderByDesc('created_at')->paginate(10);
        return view('admin.product.list')->with(['products' => $products]);
    }

    // Product Create Form
    public function showCreatePage(Request $request)
    {
        $categories = Category::select('id', 'name')->get();
        //dd($categories->toArray());
        return view('admin.product.create', compact('categories'));
    }

    // Create Product
    public function create(Request $request)
    {
        // Call the request validator helper
        $this->productValidator($request);

        // retrieve values from the form
        $productName = $request->name;
        $price = $request->price;
        $stock = $request->stock;
        $description = $request->description;
        $image = $request->file('image');
        $categoryId = $request->categoryId;

        //make the image usable by renaming with unique names to avoid naming conflicts
        $fileName = time() . "_" . uniqid() . "." . $image->getClientOriginalExtension();
        $uploadPath = public_path("uploads");
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // move image to the uploads folder under public
        $image->move($uploadPath, $fileName);
        //dd($request->toArray());
        // prepare data to be put into the products table
        $data = [
            'name' => $productName,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $categoryId,
            'description' => $description,
            'image' => $fileName,
        ];

        // create product and return to the product list page
        Product::create($data);
        return to_route('product#list')->with('message', 'Product successfully created');

    }

    //Product Details page 
    public function detailsPage($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.id', $id)
            ->first();
        //dd($product);
        return view('admin.product.details', compact('product'));

    }

    // Product Edit Page
    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.edit')->with(['product' => $product, 'categories' => $categories]);
    }

    // Product Update Function
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return to_route('product#list')->with('error', 'Product not found.');
        }

        $this->productValidator($request, $id);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->categoryId,
            'description' => $request->description
        ];

        $hasChanges = false;
        foreach ($data as $key => $value) {
            if ($product->$key != $value) {
                $hasChanges = true;
                break;
            }
        }

        $newImage = $request->file('image');
        if ($newImage) {
            $hasChanges = true;

            $oldImage = public_path('uploads/' . $product->image);
            //dd(public_path(), $oldImage, file_exists($oldImage));


            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $fileName = time() . "_" . uniqid() . "." . $newImage->getClientOriginalExtension();
            $uploadPath = public_path("uploads");
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $newImage->move($uploadPath, $fileName);
            $data['image'] = $fileName;
        }

        if (!$hasChanges) {
            return to_route('product#list')->with('message', 'No changes were made.');
        }


        $product->update($data);

        return to_route('product#list')->with('message', 'Product successfully updated.');
    }

    // Delete Product Function
    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return back();
    }

    // Helper function that validates product create and update requests
    private function productValidator(Request $request, $id = null)
    {
        $rules = [
            'name' => 'required|min:2|max:100|unique:products,name,' . $id,
            'price' => 'required|min:2|integer',
            'stock' => 'required|integer',
            'description' => 'required|min:10|max:1000',
            'categoryId' => 'required'
        ];

        // For create — image required
        if (!$id) {
            $rules['image'] = 'required|image|mimes:jpg,jpeg,png,gif,svg|max:5124';
        } else {
            // For update — image optional
            $rules['image'] = 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:5124';
        }

        $messages = [
            'image.image' => 'Please upload a valid image.',
            'image.mimes' => 'Only jpg, jpeg, png, gif, and svg are allowed.',
            'image.max' => 'Image size must not exceed 5MB.'
        ];

        $request->validate($rules, $messages);
    }

}
