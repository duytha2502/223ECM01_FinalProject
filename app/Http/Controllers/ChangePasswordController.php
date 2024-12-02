<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('password', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ];

        $messages = [
            'confirm_password.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withMessage('Password invalid');
        }

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->withMessage("Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->withMessage('Password changed successfully!');
    }
}
