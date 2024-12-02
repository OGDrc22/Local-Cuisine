<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bookuser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterNewUserController extends Controller
{
    function register(Request $request) {
        $user = bookuser::create([
            'username' => request('username'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);
        Auth::login($user);
        return redirect(route('home.custom'))->with('success', 'Registered Successfully');
    }
}
