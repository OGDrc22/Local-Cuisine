<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bookuser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthLoginController extends Controller
{
    // public function loginuser(Request $request)
    // {

    //     $user = bookuser::where('Email', '=', $request->email)->first();
    //     if($user && Hash::check($request->password, $user->password)) {
    //         Auth::login($user);
    //         // return "Goods";
    //         return redirect()->intended('home');
    //     }
    //     else {
    //         return "Errorrrrr";
    //     }

    // }

    public function loginuser(Request $request)
    {

        // dd("called");
        $user = bookuser::where('email', '=', $request->email)->first();

        if (!$user) {
            // return "User not found!";
            return redirect()->back()->withErrors(['email' => 'User not found!']);
        }

        if (!Hash::check($request->password, $user->password)) {
            // return "Password mismatch!";
            return redirect()->back()->withErrors(['password' => 'Incorrect Password!']);
        }

        Auth::login($user);

        if (Auth::check()) {
            return redirect()->intended('home')->with('welcome', 'Welcome '. $user->username);
        }

        return redirect()->back()->withErrors(['general'=> 'Something went wrong.']);
    }
}
