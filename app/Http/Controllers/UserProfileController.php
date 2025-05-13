<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use App\Models\bookuser;
use App\Models\rating;
use Auth;

class UserProfileController extends Controller
{
    public function getUserProfile() {

        $user = Auth::user();
        if (Auth::user() == null) {
            return redirect('/registernewuser');
        }
        $get_userId = $user->id;  
        $get_userName = Auth::user()->username;
        $get_userEmail = Auth::User()->email;
        $get_userLevel = Auth::user()->chefs_level;
        $get_profilepic = Auth::user()->profilepic;

        // dd($get_userLevel);

        // Users books
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

        // dd($books);

        // **Users Book

        return view('/userprofile', compact('get_userId', 'get_userName', 'get_userEmail', 'get_userLevel', 'get_profilepic', 'books'));
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
        
        // dd($request->all());

        $user = Auth::user();
        $user -> username = $request->input('username');
        $user -> email = $request->input('email');
        $user -> chefs_level = $request->input('chefs_level');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        // Return JSON if AJAX (for fetch)
        if ($request->ajax()) {
            return response()->json(['success' => true, 'filename' => $user->profilepic]);
        }
        return redirect()->back()->with('success', 'Updated Successfully');
    }

    public function updateProfilePicture(Request $request, $id)
    {
        try {
            $request->validate([
                'profilepic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
            ]);

            $user = Auth::user();

            if ($request->hasFile('profilepic')) {
                $image = $request->file('profilepic');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                // Delete old profile picture if it exists
                if ($user->profilepic) {
                    $oldPath = storage_path('app/public/profilepics/' . $user->profilepic);
                    if (file_exists($oldPath)) {
                        unlink($oldPath); // delete the old image file
                    }
                }

                if ($image->isValid()) {
                    $image->storeAs('profilepics', $filename, 'public');
                    $user->profilepic = $filename;
                } else {
                    return response()->json(['error' => 'Image is not valid.'], 422);
                }
            }

            $user->save();

            return response()->json(['message' => 'Profile picture updated']);
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }



    function deleteUser($get_userId) {
        $user = Auth::user();

        books::where('userId', $user->id)->delete();

        // Delete profile picture from public folder
        if ($user->profilepic) {
            $profilePath = public_path('images/profile/' . $user->profilepic);
            if (file_exists($profilePath)) {
                unlink($profilePath);
            }
        }
        $user->delete();
        return redirect(route('welcome'))->with('deleted', 'Account Deleted Successfully'); 
    }

    public function logout() {
        Auth::logout(); 
        return redirect()->route('welcome');
    }
}
