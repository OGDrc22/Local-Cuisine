<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bookuser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterNewUserController extends Controller
{
    function register(Request $request) {
        $request->validate([ 
            'username' => ['required', 'string', 'max:255', 'unique:bookuser,username'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:bookuser,email']
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        
        $user = bookuser::create([
            'username' => request('username'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);
        Auth::login($user);
        return redirect(route('home.custom'))->with('success', 'Registered Successfully');
    }
}
