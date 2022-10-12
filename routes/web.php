<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LocalizationController;

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

// Set Locale
Route::get('/locale/{locale}', [LocalizationController::class, 'setLang']);

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

Route::controller(ListingController::class)->group(function () {
    // All Listings
    Route::get('/', 'index');

    // Single Listing
    Route::get('/listings/{listing}', 'show')->where('listing', '[0-9]+');

    // Form to Create New Listing
    Route::get('/listings/create', 'create')->middleware('auth');

    // Store New Listing
    Route::post('/listings', 'store')->middleware('auth');

    // Form to Edit Listing
    Route::get('/listings/{listing}/edit', 'edit')->middleware('auth');

    // Update Listing
    Route::put('/listings/{listing}', 'update')->middleware('auth');

    // Delete Listing
    Route::delete('/listings/{listing}', 'delete')->middleware('auth');

    // Manage Listing
    Route::get('/listings/manage', 'manage')->middleware('auth');
});

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// Form to Create/Register User
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Store New User
Route::post('/users', [UserController::class, 'store']);

// Form to User Login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User
Route::post('/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
