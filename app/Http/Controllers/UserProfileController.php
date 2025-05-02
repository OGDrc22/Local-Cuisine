<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use Auth;

class UserProfileController extends Controller
{
    public function getUserProfile() {

        $user = Auth::user();
        $get_userId = $user->id;  
        $get_userName = Auth::user()->username;
        $get_userEmail = Auth::User()->email;
        $get_userLevel = Auth::user()->chefs_level;

        return view('/userprofile', compact('get_userId', 'get_userName', 'get_userEmail', 'get_userLevel'));
    }

    public function getUserId($get_userId) {
        $get_userId = $user->id;
        return view('/userprofile', compact('get_userId'));
    }

    public function updateProfile(Request $request, $id) {
        $request->validate([ 
            'chefs_level' => ['nullable', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'], 
            'email' => ['required', 'string', 'email', 'max:255']
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        $user = Auth::user();
        $user -> username = $request->input('username');
        $user -> email = $request->input('email');
        $user -> chefs_level = $request->input('chefs_level');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user -> save();
        return redirect('/userprofile');
    }

    function deleteUser($get_userId) {
        $user = Auth::user();

        books::where('userId', $user->id)->delete();
        $user->delete();
        return redirect(route('welcome'))->with('success', 'Account Deleted Successfully'); 
    }

    public function logout() {
        Auth::logout(); 
        return redirect()->route('welcome');
    }
}
