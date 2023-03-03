<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/search', [HomepageController::class, 'search'])->name('search');
Route::get('/home', [HomepageController::class, 'tweet'])->name('tweet');
Route::get('/tweets', [HomepageController::class, 'myTweets'])->name('myTweets');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/addTweet', [TweetController::class, 'store'])->name('addTweet');
    Route::get('/liked/{id}', [TweetController::class, 'like']);
    Route::get('/tweet/{id}', [TweetController::class, 'tweet']);
});
require __DIR__ . '/auth.php';
