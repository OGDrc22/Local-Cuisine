<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bookuser;
use App\Models\books;

class WelcomeController extends Controller
{
    public function getBooks() {

        $otherUser = bookuser::all();

        $userWithBooks = [];
        foreach ($otherUser as $oUser) {
            $uBook = books::where('userId', $oUser->id)->get();
            $userWithBooks[] = [
                'username' => $oUser->username,
                'books' => $uBook
            ];
        }

        return view('welcome', compact('uBook', 'userWithBooks'));
    }
}
