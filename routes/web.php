<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\bookuser;
use App\Models\books;
use App\Http\Controllers\RegisterNewUserController;
use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomHomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NewBookController;
use App\Http\Controllers\EditBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteController;
use App\Http\Middleware\PreventDirectAccess;

Route::get('/', [WelcomeController::class, 'getBooks'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/loginuser', [App\Http\Controllers\Auth\AuthLoginController::class, 'loginuser'])->name('loginuser');


Route::get('/userprofile', function() {
    return view('userprofile');
});

Route::post('/userprofile', function() {
    return view('userprofile');
})->name('userprofile');

Route::get('/userprofile', [UserProfileController::class, 'getUserProfile']);
Route::post('logout', [UserProfileController::class, 'logout'])->name('logout');

Route::get('userprofile/{id}', [UserProfileController::class, 'getUserId']);
Route::put('userprofile/{id}', [UserProfileController::class, 'updateProfile'])->name('userprofile.update');
Route::put('userprofileDelete/{id}', [UserProfileController::class, 'deleteUser'])->name('userprofile.delete');

Route::get('/about', function() {
    return view('about');
})->name('about');


Route::get('/registernewuser', function () {
    return view('registernewuser');
});

Route::post('/registernewuser', [RegisterNewUserController::class, 'register'])->name('register.new');


Route::middleware( PreventDirectAccess::class)->group(function () {
    Route::get('/home', [CustomHomeController::class, 'getUser'])->name('home.custom');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('userprofile/{id}', [UserProfileController::class, 'updateProfile'])->name('userprofile.update');
    
    Route::get('/newBook', [NewBookController::class, 'getUserProfile'])->name('newBook');

    Route::get('newBook/{id}', [NewBookController::class, 'getUserId']);
    Route::get('/newBook.profile', [NewBookController::class, 'getUserProfile'])->name('newBook.profile');
    Route::post('/newBook/create', [NewBookController::class, 'create'])->name('newBook.create');

    Route::get('/editBook', [EditBookController::class, 'getUserProfile'])->name('editBook');
    Route::get('/editBook/{id}', [EditBookController::class, 'edit'])->name('editBook.edit');
    Route::put('/editBook/{id}', [EditBookController::class, 'update'])->name('editBook.update');
    Route::delete('/deleteBook/{id}', [EditBookController::class, 'destroy'])->name('deleteBook');

    Route::get('/favorites', [FavoriteController::class, 'getFavBooks'])->name('favBook');
});



Route::get('/book/{id}', [BookController::class, 'show'])->name('book.details');
Route::get('/welcome', [WelcomeController::class, 'getBooks']);


Route::post('/add_favorite', [BookController::class, 'addFavorite']);
Route::post('/remove_favorite', [BookController::class, 'removeFavorite']);



require __DIR__.'/auth.php';
