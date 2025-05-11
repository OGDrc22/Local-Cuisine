<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $star_rated = $request -> input('rating');
        $book_id = $request -> input('bookId');
        // return $star_rated = $request -> input('userId');
        
        $existing_rating = rating::where('user_id', Auth::id())->where('book_id', $book_id)->first();
        if($existing_rating) {
            $existing_rating -> stars_rated = $star_rated;
            $existing_rating -> update();
        } else {
            rating::create([
                'user_id'=> Auth::id(),
                'book_id'=> $book_id,
                'stars_rated'=> $star_rated
            ]);
        }
        // return redirect()->back()->with('message', $star_rated . 'star(s) rated');
        return response()->json(['message' => 'Rated Successfully', 'status' => 'success']);
        // return redirect()->back()->with('rated_message', 'Rated Successfully');

    }
}
