<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //User Home Page
    public function home()
    {
        $products = Product::select('products.id', 'products.name', 'products.price', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->when(request('category_name'), function ($query) {
                $query->where('categories.name', request('category_name'));
            })
            ->orderByDesc('products.created_at')
            ->paginate(6);
        return view('user.dashboard.home', compact('products'));
    }

    // Product Details Page
    public function productDetails($id)
    {
        $product = Product::select('products.id', 'products.name', 'products.price', 'products.stock', 'products.description', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->first();

        $comments = Comment::select('comments.*', 'users.profile', 'users.name as username')
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.product_id', $product->id)
            ->orderByDesc('created_at')
            ->get();

        $relatedProducts = Product::select('products.id', 'products.name', 'products.price', 'products.stock', 'products.description', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.name', '=', $product->category_name)
            ->get();




        return view('user.product.details', compact('product', 'relatedProducts', 'comments'));
    }

    public function comment(Request $request)
    {
        Comment::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'message' => $request->comment
        ]);

        return back()->with('message', 'comment success');
    }

}
