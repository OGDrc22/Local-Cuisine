<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\books;

class EditBookController extends Controller
{

    public function edit($id) {
        $book = books::findOrFail($id);
        $user = Auth::user();
        $get_userId = $user->id;
        $get_userName = Auth::user()->username;
        $get_profilepic = Auth::user()->profilepic;
        return view('/editBook', compact('book', 'get_userId', 'get_userName', 'get_profilepic'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'userId' => 'required', //|exists:bookusers,id
            'recipeTitle' => 'required|string|max:255',
            'recipeIngridients' => 'required|string',
            'recipeDescription' => 'required|string',
            'recipeCategory' => 'required|string',
            'recipeOrigin' => 'nullable|string|max:255',
            'coverImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $book = books::findOrFail($id);

        if ($request->hasFile('coverImage')) {
            if ($book->coverImage) {
                Storage::disk('public')->delete($book->coverImage);
            }
            $file = $request->file('coverImage');
            if ($file->isValid()) {
                // Store file and debug the path
                $coverImagePath = $file->store('cover_images', 'public');
                $book->coverImage = $coverImagePath;
                // dd($coverImagePath);
            } else {
                return "File is not valid.";
                // dd('Uploaded file is not valid.');
            }
        }

        $book->userId = $validated['userId'];
        $book->recipeTitle = $validated['recipeTitle'];
        $book->recipeIngridients = $validated['recipeIngridients'];
        $book->recipeDescription = $validated['recipeDescription'];
        $book->recipeOrigin = $validated['recipeOrigin'];
        $book->recipeCategory = $validated['recipeCategory'];

        $book->save();
        
        return redirect(route('home.custom'))->with('success', 'Updated Successfully');
    }

    public function destroy($id) { $book = books::findOrFail($id);
        if ($book->coverImage) { 
            Storage::disk('public')->delete($book->coverImage); 
        }

        $book->delete();
        
        return redirect(route('home.custom'))->with('success', 'Book Deleted Successfully'); 
    }
}
