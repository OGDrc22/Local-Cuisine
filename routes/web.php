<?php

use App\Http\Controllers\about;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\bookuser;
use App\Models\books;
use App\Http\Controllers\RegisterNewUserController;
use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\NewBookController;
use App\Http\Controllers\EditBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteController;
use App\Http\Middleware\PreventDirectAccess;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\aboutController;
use Illuminate\Http\Request;

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
// Route::put('userprofile/{id}', [UserProfileController::class, 'updateProfile'])->name('userprofile.update');
Route::put('userprofileDelete/{id}', [UserProfileController::class, 'deleteUser'])->name('userprofile.delete');

Route::get('/about', function() {
    return view('about');
})->name('about');


Route::get('/registernewuser', function () {
    return view('registernewuser');
});

Route::post('/registernewuser', [RegisterNewUserController::class, 'register'])->name('register.new');


Route::middleware( PreventDirectAccess::class)->group(function () {
    Route::get('/home', [HomeController::class, 'getData'])->name('home.custom');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('userprofile/{id}/update', [UserProfileController::class, 'updateProfile'])->name('userprofile.update');
    Route::put('userprofile/{id}/updatepic', [UserProfileController::class, 'updateProfilePicture'])->name('userprofile.updatepic');

    // Route::any('userprofile/{id}', function (Request $request, $id) {
    //     dd('Hit controller with method: ' . $request->method());
    // });
    
    Route::get('/newBook', [NewBookController::class, 'getUserProfile'])->name('newBook');

    Route::get('newBook/{id}', [NewBookController::class, 'getUserId']);
    Route::get('/newBook.profile', [NewBookController::class, 'getUserProfile'])->name('newBook.profile');
    Route::post('/newBook/create', [NewBookController::class, 'create'])->name('newBook.create');

    Route::get('/editBook', [EditBookController::class, 'getUserProfile'])->name('editBook');
    Route::get('/editBook/{id}', [EditBookController::class, 'edit'])->name('editBook.edit');
    Route::put('/editBook/{id}', [EditBookController::class, 'update'])->name('editBook.update');
    Route::delete('/deleteBook/{id}', [EditBookController::class, 'destroy'])->name('deleteBook');

    Route::get('/favorites', [FavoriteController::class, 'getFavBooks'])->name('favBook');

    Route::post('add-rating', [RatingController::class, 'add'])->name('add-rating');

    Route::redirect('/home/tables', 'tables/overview');

    Route::get('/home/tables/overview', [HomeController::class, 'overview'])->name('home.tables.overview');
    Route::get('/home/tables/users', [HomeController::class, 'users'])->name('home.tables.users');
    Route::get('/home/tables/books', [HomeController::class, 'books'])->name('home.tables.books');
    Route::get('/home/tables/ratings', [HomeController::class, 'ratings'])->name('home.tables.ratings');


    Route::get('/home/admin', [HomeController::class, 'home_admin'])->name('home.admin');
    Route::get('/home/settings', [HomeController::class, 'settings_view'])->name('home.settings');

    Route::put('/home/tables', [HomeController::class, 'update'])->name('edit.admin');


    Route::post('add-comment', [BookController::class, 'addComment'])->name('add-comment');
    Route::get('delete-comment/{id}', [BookController::class, 'deleteComment'])->name('delete-comment');
    Route::get('edit-comment/{id}', [BookController::class, 'editComment'])->name('edit-comment');
    Route::get('/book/{id}', [BookController::class, 'getComments'])->name('book.view');

});



Route::get('/book/{id}', [BookController::class, 'show'])->name('book.details');
Route::get('/welcome', [WelcomeController::class, 'getBooks']);


Route::get('/welcome', function() {
    return view('welcome');
});


Route::post('/add_favorite', [BookController::class, 'addFavorite']);
Route::post('/remove_favorite', [BookController::class, 'removeFavorite']);

// Route::get('about', [aboutController::class, 'username']);
// Route::get('/search', [SearchController::class, 'index'])->name('search');



require __DIR__.'/auth.php';
