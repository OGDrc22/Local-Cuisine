<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserProfileController extends Controller
{
    public function getUserProfile() {

        $user = Auth::user();
        $get_userId = $user->id;  
        $get_userName = Auth::user()->username;
        $get_userEmail = Auth::User()->email;

        return view('/userprofile', compact('get_userId', 'get_userName', 'get_userEmail'));
    }

    public function getUserId($get_userId) {
        $get_userId = $user->id;
        return view('/userprofile', compact('get_userId'));
    }

    public function updateProfile(Request $request, $id) {
        $user = Auth::user();
        $user -> username = $request->input('username');
        $user -> email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user -> save();
        return redirect('/userprofile');
    }

    function deleteUser($get_userId) {
        $user = Auth::user();
        $user->delete();
        return redirect()->route('welcome'); 
    }

    public function logout() {
        Auth::logout(); 
        return redirect()->route('welcome');
    }
}
