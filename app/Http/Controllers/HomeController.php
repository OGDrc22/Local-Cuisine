<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\books;
use App\Models\bookuser;
use App\Models\rating;

class HomeController extends Controller
{
    public function getData(Request $request) {

        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;
        $get_profilepic = Auth::user()->profilepic;

        $books = books::where('userId', $user->id)->get();

        foreach ($books as $book) {
            $bookId = $book->id;
            $rates = rating::where('book_id', $bookId)->whereNotNull('book_id')->get();
            $ratesSum = rating::where('book_id', $bookId)->whereNotNull('book_id')->sum('stars_rated');
            $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
            $book->starsCount = $starsCount;
            $book->ratings = $rates->count();

            $book -> username = bookuser::where('id', $book->userId)->first()->username;
        }

        $results = books::all();
        $query = $request -> input('query') ?? '';

        if ($query) {
            $a = books::select('books.*', 'bookuser.username')
            ->leftJoin('bookuser', 'books.userId', '=', 'bookuser.id')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('books.recipeTitle','LIKE', "%{$query}%")
                    ->orWhere('books.recipeIngridients','LIKE', "%{$query}%")
                    ->orWhere('bookuser.email', 'LIKE', "%{$query}%")
                    ->orWhere('bookuser.username', 'LIKE', "%{$query}%");
            })
            ->get();

            $results = $a->map(function ($book) {
                $bookId = $book->id;
                $rates = rating::where('book_id', $bookId)->get();
                $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                $book->starsCount = $starsCount;
                $book->ratings = $rates->count();
                return $book;
            });
        }

        
        $category = $request -> input("category") ?? "";
        $userWithBooks = [];
        $categorizedBooks = [];

        if ($category) {

            $check = false;

            $allBook = books::where('recipeCategory', $category)
                        ->get(['id', 'userId']);
                        
            foreach ($allBook as $key) {
                $book = books::find($key->id);
                if ($book) {
                    $check = true;

                    $bookId = $book->id;
                    $rates = rating::where('book_id',  $bookId)->get();
                    $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                    $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                    $book -> starsCount = $starsCount;
                    $book -> ratings = $rates->count();

                    $creator = bookuser::where('id', $book->userId)->first();
                    $book -> username = $creator->username;

                    $categorizedBooks[] = $book;
                }
            }
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

                    $recipeCategory = $book->recipeCategory;
                    $book->recipeCategory = $recipeCategory;

                    // Get the creator's username of the book
                    $creator = bookuser::where('id', $book->userId)->first();
                    $book->username = $creator->username;
        
                    $userWithBooks[] = $book;

                }

                // dd($recipeCategory);

            }
        //     $check = false;
        //     $allUser = bookuser::all();
            
        //     foreach ($allUser as $oUser) {
                
        //         $aBook = books::where('userId', $oUser->id)->get();
        //         $bookWithRatings = $aBook->map(function ($book) {
        //             $bookId = $book->id;
        //             $rates = rating::where('book_id',  $bookId)->get();
        //             $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
        //             $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
        //             $book -> starsCount = $starsCount;
        //             $book -> ratings = $rates->count();

        //             return $book;
        //             // dd($aBook);
                    
        //         });
        //         $userWithBooks[] = [
        //             'username' => $oUser->username,
        //             'books' => $bookWithRatings
        //         ];
        //     }
        }
        
        // $output = shell_exec('python ' . base_path('public/assets/python/Top5Recommendation_RF.py'));
        // $output = trim($output);
        // // dd($output);

        // $recommendation = json_decode($output, true);

        // if (json_last_error() !== JSON_ERROR_NONE) {
        //     dd(json_last_error_msg()); // Debugging: Check for JSON decoding errors
        // }

        // $r_book_id = array_column($recommendation, 'book_id');
        // $r_book_rate = array_column($recommendation, 'p_rating');
    
        // $recommendedBooks = [];
        
        // foreach ($r_book_id as $key) { 
        //     $book = books::find($key); // Find the book by ID
        //     if ($book) { 
                    
        //         // Calculate starsCount and ratings
        //         $bookId = $book->id;
        //         $rates = rating::where('book_id', $bookId)->get();
        //         $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
        //         $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
        //         $book->starsCount = $starsCount;
        //         $book->ratings = $rates->count();

        //         // Get the creator's username of the book
        //         $creator = bookuser::where('id', $book->userId)->first();
        //         $book->username = $creator->username;
    
        //         $recommendedBooks[] = $book;

        //     }
        // }

        $output = shell_exec('python ' . base_path('public/assets/python/Top5Recommendation_RF.py') . ' 2>&1');
        $output = trim($output);

        $recommendedBooks = [];

        try {
            $recommendation = json_decode($output, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($recommendation)) {
                $r_book_id = array_column($recommendation, 'book_id');
                
                foreach ($r_book_id as $key) { 
                    $book = books::find($key); // Find the book by ID
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

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            return view('admin_dashboard', compact('userType', 'get_userName', 'get_profilepic' , 'books', 'userWithBooks', 'results', 'query', 'category', 'categorizedBooks', 'check', 'recommendedBooks'));
        } else {
            return view('home', compact('get_userName', 'get_profilepic' , 'books', 'userWithBooks', 'results', 'query', 'category', 'categorizedBooks', 'check', 'recommendedBooks'));
        }
    }


    public function logout() {
        Auth::logout(); 
        return redirect()->route('welome');
    }




    public function home_admin(Request $request) {

        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $books = books::where('userId', $user->id)->get();

        foreach ($books as $book) {
            $bookId = $book->id;
            $rates = rating::where('book_id', $bookId)->get();
            $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
            $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
            $book->starsCount = $starsCount;
            $book->ratings = $rates->count();

            $book -> username = bookuser::where('id', $book->userId)->first()->username;
        }

        $results = books::all();
        $query = $request -> input('query') ?? '';

        if ($query) {
            $a = books::select('books.*', 'bookuser.username')
            ->leftJoin('bookuser', 'books.userId', '=', 'bookuser.id')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('books.recipeTitle','LIKE', "%{$query}%")
                    ->orWhere('books.recipeIngridients','LIKE', "%{$query}%")
                    ->orWhere('bookuser.email', 'LIKE', "%{$query}%")
                    ->orWhere('bookuser.username', 'LIKE', "%{$query}%");
            })
            ->get();

            $results = $a->map(function ($book) {
                $bookId = $book->id;
                $rates = rating::where('book_id', $bookId)->get();
                $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                $book->starsCount = $starsCount;
                $book->ratings = $rates->count();
                return $book;
            });
        }

        
        $category = $request -> input("category") ?? "";
        $userWithBooks = [];
        $categorizedBooks = [];

        if ($category) {

            $check = false;

            $allBook = books::where('recipeCategory', $category)
                        ->get(['id', 'userId']);
                        
            foreach ($allBook as $key) {
                $book = books::find($key->id);
                if ($book) {
                    $check = true;

                    $bookId = $book->id;
                    $rates = rating::where('book_id',  $bookId)->get();
                    $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                    $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                    $book -> starsCount = $starsCount;
                    $book -> ratings = $rates->count();

                    $creator = bookuser::where('id', $book->userId)->first();
                    $book -> username = $creator->username;

                    $categorizedBooks[] = $book;
                }
            }
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

                    $recipeCategory = $book->recipeCategory;
                    $book->recipeCategory = $recipeCategory;

                    // Get the creator's username of the book
                    $creator = bookuser::where('id', $book->userId)->first();
                    $book->username = $creator->username;
        
                    $userWithBooks[] = $book;

                }

                // dd($recipeCategory);

            }
        //     $check = false;
        //     $allUser = bookuser::all();
            
        //     foreach ($allUser as $oUser) {
                
        //         $aBook = books::where('userId', $oUser->id)->get();
        //         $bookWithRatings = $aBook->map(function ($book) {
        //             $bookId = $book->id;
        //             $rates = rating::where('book_id',  $bookId)->get();
        //             $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
        //             $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
        //             $book -> starsCount = $starsCount;
        //             $book -> ratings = $rates->count();

        //             return $book;
        //             // dd($aBook);
                    
        //         });
        //         $userWithBooks[] = [
        //             'username' => $oUser->username,
        //             'books' => $bookWithRatings
        //         ];
        //     }
        }
        

                
        $output = shell_exec('python ' . base_path('public/assets/python/Top5Recommendation_RF.py') . ' 2>&1');
        $output = trim($output);

        $recommendedBooks = [];

        try {
            $recommendation = json_decode($output, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($recommendation)) {
                $r_book_id = array_column($recommendation, 'book_id');
                
                foreach ($r_book_id as $key) { 
                    $book = books::find($key); // Find the book by ID
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
            
                        $recommendedBooks[] = $book;
        
                    }
                }
            }
        } catch (\Exception $e) {
            // Optional: Log the error if you want to debug later
            \Log::error("Recommendation script failed", ['error' => $e->getMessage()]);
        }

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            // dd($userWithBooks);
            return view('Admin_Tabs.Home', compact('userType', 'get_userName', 'books', 'userWithBooks', 'results', 'query', 'category', 'categorizedBooks', 'check', 'recommendedBooks'));
        } 

    }



    public function settings_view() {
        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $query = '';
        $books = [];
        $check = false;
        $category = '';
        $categorizedBooks = [];
        $recommendedBooks = [];
        $userWithBooks = [];

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            // dd($userWithBooks);
            return view('Admin_Tabs.Settings', compact('userType', 'get_userName', 'query', 'books', 'check', 'category', 'categorizedBooks', 'recommendedBooks', 'userWithBooks'));
        } else {
            return view('welcome');
        }
    }




    public function overview() {

        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $data = bookuser::all();
        $table_overview = []; 
        foreach ($data as $key) {
            $books = books::where('userId', $key->id)->pluck('recipeTitle');

            $aBook = books::where('userId', $key->id)->get();
            // dd($books);

            $created_books = $aBook->map(function ($book) {
                $bookId = $book->id;
                $rates = rating::where('book_id', $bookId)->get();
                $ratesSum = rating::where('book_id', $bookId)->sum('stars_rated');
                $starsCount = $rates->count() > 0 ? $ratesSum / $rates->count() : 0;
                // $book->starsCount = $starsCount;
                // $book->ratings = $rates->count();

                $creator = bookuser::where('id', $book->userId)->first();
                $book->username = $creator->username;

                return [
                    'book_id' => $book->id,
                    'recipeTitle' => $book->recipeTitle,
                    'recipeIngridients' => $book->recipeIngridients,
                    'recipeDescription' => $book->recipeDescription,
                    'recipeCategory' => $book->recipeCategory,
                    'starsCount' => $starsCount,
                    'ratings' => $rates->count()
                ];
                
            });

            $table_overview[] = [
                'id' => $key->id,
                'username' => $key->username,
                'email' => $key->email,
                // 'created_books' => $books->toArray(),
                'created_books' => $created_books->toArray(),
            ];
        }


        // dd($table_overview);


        

        $query = '';
        $books = [];
        $check = false;
        $category = '';
        $categorizedBooks = [];
        $recommendedBooks = [];
        $userWithBooks = [];

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            // dd($userWithBooks);
            return view('AdminTableTab.overview', compact('userType', 'get_userName', 'table_overview', 'query', 'books', 'check', 'category', 'categorizedBooks', 'recommendedBooks', 'userWithBooks'));
        } else {
            return view('welcome');
        }
    }

    public function users() {

        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $data = bookuser::all();
        $table_users = []; 
        foreach ($data as $key) {
            $table_users[] = [
                'id' => $key->id,
                'username' => $key->username,
                'email' => $key->email,
                'user_type' => $key->user_type,
                'created_at' => $key->created_at,
                'updated_at' => $key->updated_at
            ];
        }

        $query = '';
        $books = [];
        $check = false;
        $category = '';
        $categorizedBooks = [];
        $recommendedBooks = [];
        $userWithBooks = [];

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            // dd($table_users);
            return view('AdminTableTab.users', compact('userType', 'get_userName', 'table_users', 'query', 'books', 'check', 'category', 'categorizedBooks', 'recommendedBooks', 'userWithBooks'));

        } else {
            return view('welcome');
        }
    }

    public function books() {
        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $allBook = books::pluck('id')->toArray();
        $table_books = [];

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
    
                $table_books[] = $book;

            }

        }

        $query = '';
        $books = [];
        $check = false;
        $category = '';
        $categorizedBooks = [];
        $recommendedBooks = [];
        $userWithBooks = [];

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            // dd($table_books);
            return view('AdminTableTab.books', compact('userType', 'get_userName', 'table_books', 'query', 'books', 'check', 'category', 'categorizedBooks', 'recommendedBooks', 'userWithBooks'));

        } else {
            return view('welcome');
        }

    }


    // public function update(Request $request, $id) {
    //     // dd($type);
    //     $validated = $request->validate([
    //         'userId' => 'required', //|exists:bookusers,id
    //         'recipeTitle' => 'required|string|max:255',
    //         'recipeIngridients' => 'required|string',
    //         'recipeDescription' => 'required|string',
    //         'recipeCategory' => 'required|string',
    //         'coverImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
        
    //     $book = books::findOrFail($id);

    //     if ($request->hasFile('coverImage')) {
    //         if ($book->coverImage) {
    //             Storage::disk('public')->delete($book->coverImage);
    //         }
    //         $file = $request->file('coverImage');
    //         if ($file->isValid()) {
    //             // Store file and debug the path
    //             $coverImagePath = $file->store('cover_images', 'public');
    //             $book->coverImage = $coverImagePath;
    //             // dd($coverImagePath);
    //         } else {
    //             return "File is not valid.";
    //             // dd('Uploaded file is not valid.');
    //         }
    //     }

    //     $book->userId = $validated['userId'];
    //     $book->recipeTitle = $validated['recipeTitle'];
    //     $book->recipeIngridients = $validated['recipeIngridients'];
    //     $book->recipeDescription = $validated['recipeDescription'];
    //     $book->recipeCategory = $validated['recipeCategory'];

    //     $book->save();

    //     // dd($book);
            
    //     if ($request->has('username') && $request->filled('username')) {
    //         $user = bookuser::findOrFail($request->input('userId')); // Retrieve user using hidden input value
    //         $user->username = $request->input('username');
    //         $user->save();
    //     }
        
    //     // return redirect(route('home.tables.books'))->with('success', 'Updated Successfully');
    //     return redirect()->back()->with('success', 'Updated Successfully');
    // }

    public function update(Request $request) {
        // dd($type);
        // dd($request);
        
        $user = bookuser::findOrFail($request->input('userId')); // Retrieve user using hidden input value
        
        if ($user->username !== $request->input('username')) {
            dd($request->input('username'), $request->input('userId'));
            $user->username = $request->input('username');
            $user->save();
        }
        
        if ($request->has('book_id')) {
            $book = books::findOrFail($request->input('book_id'));
        
            if ($book->recipeTitle !== $request->input('recipeTitle')) {
                // dd($request->input('recipeTitle'), $request->input('book_id'));
                $book->recipeCategory = $request->input('recipeCategory');
                $book->recipeTitle = $request->input('recipeTitle');
                $book->recipeIngridients = $request->input('recipeIngridients');
                $book->recipeDescription = $request->input('recipeDescription');
                $book->save();
                // dd($book);
            }
        }
        
        // return redirect(route('home.tables.books'))->with('success', 'Updated Successfully');
        return redirect()->back()->with('success', 'Updated Successfully');
    }

    public function updateB(Request $request) {
        dd('Route');

        $book = books::findOrFail($request->input('book_id'));
        if ($book->recipeTitle !== $request->input('recipeTitle')) {
            dd($request->input('recipeTitle'), $request->input('book_id'));
            $book->recipeCategory = $request->input('recipeCategory');
            $book->recipeTitle = $request->input('recipeTitle');
            $book->recipeIngridients = $request->input('recipeIngridients');
            $book->recipeDescription = $request->input('recipeDescription');
            $book->save();
            // dd($book);
        }

        return back()->with('success', 'Updated Successfully');
    }
    
    public function ratings() {
        $user = Auth::user();
        $get_userId = $user->id;

        $get_userName = Auth::user()->username;

        $query = '';
        $books = [];
        $check = false;
        $category = '';
        $categorizedBooks = [];
        $recommendedBooks = [];
        $userWithBooks = [];

        $userType = Auth::user()->user_type;
        if ($userType == 'admin') {
            // dd($table_users);
            return view('AdminTableTab.ratings', compact('userType', 'get_userName', 'query', 'books', 'check', 'category', 'categorizedBooks', 'recommendedBooks', 'userWithBooks'));

        } else {
            return view('welcome');
        }

    }
}
