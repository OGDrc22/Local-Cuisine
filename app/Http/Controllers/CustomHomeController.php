<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\books;
use App\Models\bookuser;

class CustomHomeController extends Controller
{
    public function getUser() {

        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $books = books::where('userId', $user->id)->get();

        $otherUser = bookuser::all();

        $userWithBooks = [];
        foreach ($otherUser as $oUser) {
            $uBook = books::where('userId', $oUser->id)->get();
            $userWithBooks[] = [
                'username' => $oUser->username,
                'books' => $uBook
            ];
        }

        return view('home', compact('get_userName', 'books', 'userWithBooks'));
    }


    public function logout() {
        Auth::logout(); 
        return redirect()->route('welome');
    }
}
