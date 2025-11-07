<?php

namespace App\Http\Controllers;

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
}
