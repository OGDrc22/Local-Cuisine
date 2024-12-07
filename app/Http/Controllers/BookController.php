<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use App\Models\bookuser;
use App\Models\favorites;
use Auth;

class BookController extends Controller
{
    public function show($id) {
        $user = Auth::user();
        if($user) {
            $get_userId = $user->id;
            $get_userName = $user->username;
        } else {
            $get_userId = 0;
            $get_userName = null;
        }
    
        $book = books::findOrFail($id);
        $bookUserId = $book->userId;
        $isOwner = ($get_userId == $bookUserId);
    
        $owner = bookuser::find($bookUserId);
        $ownerName = $owner ? $owner->username : null;
    
        $bookFav = favorites::where('userId', $get_userId)
                            ->where('bookId', $id)
                            ->exists();
    
        return view('openedBook', compact('get_userId', 'get_userName', 'book', 'isOwner', 'ownerName', 'bookFav'));
    }
    

    public function addFavorite(Request $request) {
        $favorites = favorites::create([
            'userId' => $request->userId,
            'bookId' => $request->bookId
        ]);
        return redirect()->back()->with('success', 'Added Successfully!');
    }

    public function removeFavorite(Request $request) {
        favorites::where('userId', $request->userId)
                ->where('bookId', $request->bookId)
                ->delete();

        return redirect()->back()->with('success', 'Removed Successfully!');  
    }

    public function checkFavorite($userId, $bookId) {
        $bookFav = favorites::where('userId', $userId)
                            ->where('bookId', $bookId)
                            ->exists();
      }
}
