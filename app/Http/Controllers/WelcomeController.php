<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bookuser;
use App\Models\books;
use App\Models\rating;

use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function getBooks(Request $request) {

        // $otherUser = bookuser::all();

        // if ($otherUser->isEmpty()) {
        //     // Return an empty array or a specific message
        //     $userWithBooks = [];
        //     $uBook = [];
        //     return view('welcome', compact('uBook', 'userWithBooks'))->with('message', 'No users found.');
        // }

        // $userWithBooks = [];
        // foreach ($otherUser as $oUser) {
        //     $uBook = books::where('userId', $oUser->id)->get();
        //     $userWithBooks[] = [
        //         'username' => $oUser->username,
        //         'books' => $uBook
        //     ];
        // }

        $query = $request -> input('query') ?? '';
        $results = [];
        
        if ($query) {
            // $results = books::join('bookuser', 'books.userId', '=', 'bookuser.id')
            // ->where('books.recipeTitle', 'LIKE', "%{$query}%")
            // ->select('books.*', 'bookuser.username')
            // ->get();
                    
                    $a = books::select('books.*', 'bookuser.username')
                        ->leftJoin('bookuser', 'books.userId', '=', 'bookuser.id') // Left Join
                        ->when($query, function ($queryBuilder) use ($query) {
                            $queryBuilder->where('books.recipeTitle', 'LIKE', "%{$query}%")
                                        ->orWhere('books.recipeIngridients', 'LIKE', "%{$query}%")
                                        ->orWhere('bookuser.email', 'LIKE', "%{$query}%")
                                        ->orWhere('bookuser.username', 'LIKE', "%{$query}%");
                        })
                        ->get();

                    
                    $results = $a->map(function ($book) {
                        $bookId = $book->id;
                        $rates = rating::where('book_id',  $bookId)->get();
                        $ratesSum = rating::where('book_id',  $bookId)->sum('stars_rated');
                        $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                        $book -> starsCount = $starsCount;
                        $book -> ratings = $rates->count();
                        return $book;
                    });
                    // return $results;

            // dd($results);
        }
        
        
        $category = $request -> input('category') ?? '';
        $userWithBooks = [];
        $categorizedBooks = [];

        if ($category) {
            
            $check = false;
            
            // $allBook = books::pluck('id')->toArray();
            $allBook = books::where('recipeCategory', $category)
                            ->get(['id', 'userId']);
            // dd($allBook);

            foreach ($allBook as $key) {
                $book = books::find($key->id);
                if ($book) { 
                    
                    $check = true;
                    // Calculate starsCount and ratings
                    $bookId = $book->id;
                    $rates = rating::where('book_id', $bookId)->get();
                    $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                    $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                    $book->starsCount = $starsCount;
                    $book->ratings = $rates->count();

                    // Get the creator's username of the book
                    $creator = bookuser::where('id', $book->userId)->first();
                    $book->username = $creator->username;
        
                    $categorizedBooks[] = $book;
                    

                }
            };
        } else {
            
            $check = false;

            $allBook = books::pluck('id')->toArray();
            $userWithBooks = [];

            foreach ($allBook as $key) {
                $book = books::find($key);
                if ($book) { 
                        
                    // Calculate starsCount and ratings
                    $bookId = $book->id;
                    $rates = rating::where('book_id', $bookId)->get();
                    $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                    $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                    $book->starsCount = $starsCount;
                    $book->ratings = $rates->count();

                    // Get the creator's username of the book
                    $creator = bookuser::where('id', $book->userId)->first();
                    $book->username = $creator->username;
        
                    $userWithBooks[] = $book;

                }

            }

            // $allUser = bookuser::all();
            // $userWithBooks = [];

            // foreach ($allUser as $oUser) {
                
            //     $aBook = books::where('userId', $oUser->id)->get();
            //     $bookWithRatings = $aBook->map(function ($book) {
                
            //         $bookId = $book->id;
            //         $rates = rating::where('book_id',  $bookId)->get();
            //         $ratesSum = rating::where('book_id',  $bookId)->sum('stars_rated');
            //         $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
            //         $book -> starsCount = $starsCount;
            //         $book -> ratings = $rates->count();
                    
            //         $book -> username = bookuser::where('id', $book->userId)->first()->username;

            //         return $book;

            //     });
                
            //     $userWithBooks[] = [
            //         'username' => $oUser->username,
            //         'books' => $bookWithRatings,
            //     ];
            // }
        }

        // dd($userWithBooks);
        // dd($results);
        // dd($aBook);

        
        $output = shell_exec('python ' . base_path('public/assets/python/Top5Recommendation_RF.py') . ' 2>&1');
        $output = trim($output);

        $recommendedBooks = [];

        try {
            $recommendation = json_decode($output, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($recommendation)) {
                $r_book_id = array_column($recommendation, 'book_id');
                
                foreach ($r_book_id as $key) { 
                    $book = books::find($key);
                    if ($book) {
                        $bookId = $book->id;
                        $rates = rating::where('book_id', $bookId)->get();
                        $ratesSum = $rates->sum('stars_rated');
                        $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;

                        $book->starsCount = $starsCount;
                        $book->ratings = $rates->count();

                        $creator = bookuser::find($book->userId);
                        $book->username = $creator ? $creator->username : 'Unknown';

                        $recommendedBooks[] = $book;
                    }
                }
            }
        } catch (\Exception $e) {
            // Optional: Log the error if you want to debug later
            \Log::error("Recommendation script failed", ['error' => $e->getMessage()]);
        }



        // dd($recommendedBooks);
        // dd($userWithBooks);
        // dd($r_book_id, $r_book_rate, $recommendedBooks, $book);
        // dd($recommendedBooks);
        // dd($book);

        return view('welcome', compact(  'query', 'results', 'userWithBooks', 'category', 'categorizedBooks', 'check', 'recommendedBooks'));
    }
}