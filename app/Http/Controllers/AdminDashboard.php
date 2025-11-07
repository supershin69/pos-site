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

    //Profile Page
    public function profilePage($id)
    {
        $profileData = User::find($id);

        return view('admin.dashboard.profile', compact('profileData'));
    }

    // List Admins in a page
    public function listAdmin()
    {
        $admins = User::where('role', 'admin')
            ->when(request('searchKey'), function ($query, $searchKey) {
                $searchKey = strtolower($searchKey);
                $query->where(function ($subQuery) use ($searchKey) {
                    $subQuery->whereRaw('LOWER(name) LIKE ?', ["%{$searchKey}%"])
                        ->orWhereRaw('LOWER(email) LIKE ?', ["%{$searchKey}%"])
                        ->orWhere('id', (int) $searchKey);
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.dashboard.adminList', compact('admins'));
    }

    public function listUser()
    {
        $users = User::where('role', 'user')
            ->when(request('searchKey'), function ($query, $searchKey) {
                $searchKey = strtolower($searchKey);
                $query->where(function ($subQuery) use ($searchKey) {
                    $subQuery->whereRaw('LOWER(name) LIKE ?', ["%{$searchKey}%"])
                        ->orWhereRaw('LOWER(email) LIKE ?', ["%{$searchKey}%"])
                        ->orWhere('id', (int) $searchKey);
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.dashboard.userList', compact('users'));
    }

    //See other users
    public function peekUser($id)
    {
        $user = User::find($id);
        return view('admin.dashboard.peekOthers', compact('user'));
    }


    //Delete Users
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('message', 'User successfully deleted.');
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
