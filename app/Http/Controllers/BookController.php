<?php

namespace App\Http\Controllers;

use App\Models\BookComment;
use Illuminate\Http\Request;
use App\Models\books;
use App\Models\bookuser;
use App\Models\favorites;
use App\Models\rating;
use Auth;

class BookController extends Controller
{
    public function show($id) {
        $user = Auth::user();
        if($user) {
            $get_userId = $user->id;
            $get_userName = $user->username;
            $get_profilepic = Auth::user()->profilepic;
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


        $rates = rating::where('book_id', $id)->get();
        $ratesSum = rating::where('book_id', $id)->sum('stars_rated');
        $starsCount = $rates->count() > 0 ? $ratesSum/$rates->count() : 0;

        $book->starsCount = $starsCount;
        $book->ratings = $rates->count();


        $comments = BookComment::with('replies', 'user')
            ->where('book_id', $id)
            ->whereNull('parent_id') // only top-level comments
            ->orderBy('created_at', 'desc')
            ->get();

        return view('openedBook', compact('get_userId', 'get_userName', 'get_profilepic' , 'book', 'isOwner', 'ownerName', 'bookFav', 'rates' , 'starsCount', 'comments'));
    }
    

    public function addFavorite(Request $request) {
        $favorites = favorites::create([
            'userId' => $request->userId,
            'bookId' => $request->bookId
        ]);
        return redirect()->back()->with('added', 'Added Successfully!');
    }

    public function removeFavorite(Request $request) {
        favorites::where('userId', $request->userId)
                ->where('bookId', $request->bookId)
                ->delete();

        return redirect()->back()->with('removed', 'Removed Successfully!');  
    }

    public function checkFavorite($userId, $bookId) {
        $bookFav = favorites::where('userId', $userId)
                            ->where('bookId', $bookId)
                            ->exists();
    }


    public function addComment(Request $request) {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'comment' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:book_comments,id', // for replies
        ]);
    
        $comment = BookComment::create([
            'user_id' => Auth::id(),
            'book_id' => $validatedData['book_id'],
            'comment' => $validatedData['comment'],
            'parent_id' => $validatedData['parent_id'] ?? null, // for replies
        ]);
    
        // dd($comment); // Now this will be hit if everything works
    
        return redirect()->back()->with('success', 'Comment Added Successfully!');
    }

    public function editComment(Request $request, $id) {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'comment' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:book_comments,id', // for replies
        ]);
        
        $comment = BookComment::findOrFail($id);
        $comment->comment = $validatedData->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Comment Updated Successfully!');
    }

    public function deleteComment($id) {
        $comment = BookComment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment Deleted Successfully!');
    }

    public function getComments($id) {
        $book = books::findOrFail($id);

        $comments = BookComment::with('replies', 'user')
            ->where('book_id', $id)
            ->whereNull('parent_id') // only top-level comments
            ->orderBy('created_at', 'desc')
            ->get();

        dd($comments);
        return view('openedBook', compact('book', 'comments'));
    }
}
