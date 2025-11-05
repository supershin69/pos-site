<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //Profile Edit Page
    public function edit($id)
    {
        $profile = User::find($id);
        //dd($profile);
        return view('admin.profile.edit', compact('profile'));

    }

    //Profile Update Function
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->requestValidator($request, $id);

        $data = [
            'name' => $request->name,
        ];

        $hasChanges = false;
        foreach ($data as $key => $value) {
            if ($user->$key != $value) {
                $hasChanges = true;
                break;
            }
        }

        $image = $request->file('profile');
        if ($image) {
            $hasChanges = true;


            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $uploadDir = public_path('uploads/profile');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $oldImage = $user->profile;
            //dd($oldImage);
            if ($oldImage != null) {
                unlink(public_path('uploads/profile/' . $oldImage));
            }

            $image->move($uploadDir, $fileName);

            $data['profile'] = $fileName;
        }

        if (!$hasChanges) {
            return to_route('admin#profile', $id)->with('message', 'No changes detected.');
        }

        $user->update($data);

        return to_route('admin#profile', $id)->with('message', 'Profile updated successfully.');
    }

    //Change Password Page
    public function passwordEdit(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.profile.changePassword', compact('user'));
    }

    //Update Password Function
    public function passwordUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $this->changePasswordValidator($request);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors([
                'old_password' => 'Old password does not match.'
            ])->withInput();
        }


        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return to_route('admin#profile', auth()->user()->id)->with('message', 'Password successfully updated!');

    }

    private function requestValidator(Request $request, $id = null)
    {
        $rules = [
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:5124',
            'name' => 'required'
        ];
        $request->validate($rules);
    }

    private function changePasswordValidator(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ];

        $request->validate($rules);
    }
}
