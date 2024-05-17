<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Log;

class FacebookController extends Controller
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook() {

        try {      
            $facebook_user = Socialite::driver("facebook")->user();

            $user = User::where('provider_id', $facebook_user->id)->first();
            
        if (!$user) {
            $data = [
                'role_id' => 2,
                'provider_id' => $facebook_user->id,
                'name' => $facebook_user->name,
                'email' => $facebook_user->id . $facebook_user->email,
            ];

            $userConnected = User::create($data);

            auth()->login($userConnected);
            }

            auth()->login($user);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('login');
        }
    }
}
