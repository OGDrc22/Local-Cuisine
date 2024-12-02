<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books;
use Illuminate\Support\Facades\Storage;
use Auth;

class NewBookController extends Controller
{
    public function getUserProfile() {

        $user = Auth::user();
        $get_userId = $user->id;  
        $get_userName = Auth::user()->username;
        $get_userEmail = Auth::User()->email;

        return view('/newBook', compact('get_userId', 'get_userName', 'get_userEmail'));
    }

    public function getUserId($get_userId) {
        $get_userId = $user->id;
        return view('/newBook', compact('get_userId'));
    }

    function create(Request $request) {
        $validated = $request->validate([
            'userId' => 'required', //|exists:bookusers,id
            'recipeTitle' => 'required|string|max:255',
            'recipeIngridients' => 'required|string',
            'recipeDescription' => 'required|string',
            'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('coverImage')) {
            $file = $request->file('coverImage');
            if ($file->isValid()) {
                // Store file and debug the path
                $coverImagePath = $file->store('cover_images', 'public');
                // dd($coverImagePath);
            } else {
                return "File is not valid.";
                // dd('Uploaded file is not valid.');
            }
        } else {
            // return "No file uploaded.";
            // dd('No file uploaded.');
            return back()->withErrors(['coverImage' => 'Please Upload a Cover Photo'])->withInput();
        }


        $userBook = books::create([
            'userId' => $validated['userId'],
            'recipeTitle' => $validated['recipeTitle'],
            'recipeIngridients' => $validated['recipeIngridients'],
            'recipeDescription' => $validated['recipeDescription'],
            'coverImage' => $coverImagePath,
        ]);
        return redirect(route('home'))->with('success', 'Created Successfully');
    }
}
