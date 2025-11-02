<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    //REDIRECT
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    //CALLBACK
    public function callback($provider) {
        $socialData = Socialite::driver($provider)->user();
        //dd($socialData);
        $data = [
            'name' => $socialData->name ? $socialData->name : $socialData->nickname,
            'email' => $socialData->email,
            'provider_id' => $socialData->id,
            'provider_token' => $socialData->token,
            'profile' => $socialData->avatar,
            'role' => 'user',
            'provider' => $provider,
        ];

        //dd($data);

        $user = User::updateOrCreate(['provider_id' => $socialData->id ],$data);
        Auth::login($user);

        /* $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user); */

        return to_route('user#home');
    }
}
