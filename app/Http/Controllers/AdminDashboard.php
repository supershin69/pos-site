<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    // Direct Dashboard
    public function dashboard()
    {
        return view("admin.dashboard.home");
    }

    //Go to add admin page
    public function admin_creation_page()
    {
        return view('admin.dashboard.createAdmin');
    }

    //Admin creation function
    public function create_admin(Request $request)
    {
        $this->requestValidator($request);
        if (!Hash::check($request->superpassword, auth()->user()->password)) {
            return back()->with(['error' => 'Super Admin Password is incorrect.']);
        }

        $data = [
            'name' => 'admin',
            'email' => $request->email,
            'password' => Hash::make('admin12345'),
            'provider' => 'simple',
            'role' => 'admin',
        ];

        User::create($data);
        return back()->with('message', 'New Admin created successfully.');
    }

    public function profilePage($id)
    {
        $profileData = User::find($id);

        return view('admin.dashboard.profile', compact('profileData'));
    }

    //Validate Admin creation request
    private function requestValidator(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'superpassword' => 'required',
        ];

        $request->validate($rules);
    }
}
