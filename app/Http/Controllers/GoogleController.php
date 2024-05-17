<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\User;

class GoogleController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle() {

        try {      
            $google_user = Socialite::driver("google")->user();

            $user = User::where('provider_id', $google_user->id)->first();
            
        if (!$user) {
            $data = [
                'role_id' => 2,
                'provider_id' => $google_user->id,
                'name' => $google_user->name,
                'email' => $google_user->id . $google_user->email,
            ];

            $userConnected = User::create($data);

            auth()->login($userConnected);
            }

            auth()->login($user);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            // dd('sth went wrong', $th->getMessage());
            return redirect()->route('login');
        }
    }
}
