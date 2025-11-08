<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    //View User Profile
    public function viewProfile($id)
    {
        $user = User::find($id);
        return view('user.profile.profile', compact('user'));
    }

    //Profile Edit Page
    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile.edit', compact('user'));
    }

    //Profile Update Function
    public function updateProfile(Request $request, $id)
    {
        //dd($request->toArray());
        $user = User::findOrFail($id);
        //dd($request->toArray());
        $this->requestValidator($request, $id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];

        $hasChanged = false;

        foreach ($data as $key => $value) {
            if ($user->$key != $value) {
                $hasChanged = true;
                break;
            }
        }

        $newImage = $request->file('image');
        if ($newImage) {
            $hasChanged = true;

            $fileName = time() . '_' . uniqid() . '.' . $newImage->getClientOriginalExtension();

            $uploadDir = public_path('uploads/profile');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $oldImage = $user->profile;


            if ($oldImage != null and !Str::startsWith($oldImage, ['http://', 'https://'])) {
                if (file_exists(public_path($uploadDir . '/' . $oldImage))) {
                    unlink(public_path('uploads/profile/' . $oldImage));
                }
            }


            $newImage->move($uploadDir, $fileName);

            $data['profile'] = $fileName;

        }

        if (!$hasChanged) {
            return to_route('user#profile', $id)->with('message', 'No changes were made');
        }

        $user->update($data);

        return to_route('user#profile', $id)->with('message', 'Profile updated successfully');
    }

    private function requestValidator($request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|digits_between:7,15',
            'address' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
