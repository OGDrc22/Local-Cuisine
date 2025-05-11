<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\favorites;
use App\Models\books;
use App\Models\bookuser;
use App\Models\rating;
use Auth;

class FavoriteController extends Controller
{
    public function getFavBooks()
{
    $user = Auth::user();
    $get_userId = $user->id;
    $get_userName = $user->username;

    // Step 1: Fetch all favorites for the user
    $favorites = Favorites::where('userId', $get_userId)->get();

    // Step 2: Extract book IDs from the favorites
    $bookIds = $favorites->pluck('bookId')->toArray();

    // Step 3: Fetch books that match the IDs
    $books = Books::whereIn('id', $bookIds)->get();

    // Step 4: Prepare a manual data structure for the view
    $favoritedBooks = [];
    foreach ($books as $book) {
        $bookId = $book->id;
        $rates = rating::where('book_id', $bookId)->whereNotNull('book_id')->get();
        $ratesSum = rating::where('book_id', $bookId)->whereNotNull('book_id')->sum('stars_rated');
        $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
        $ratings = $rates->count();

        $favoritedBooks[] = [
            'username' => $user->username,
            'books' => $book,
            'starsCount' => $starsCount,
            'ratingsCount' => $ratings
        ];

    }

    return view('favorites', compact('get_userId', 'get_userName', 'favoritedBooks'));
}

}
