<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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

    private function requestValidator(Request $request, $id = null)
    {
        $rules = [
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:5124',
            'name' => 'required'
        ];
    }
}
