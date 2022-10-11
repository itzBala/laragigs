<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

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

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Form to Create New Listing

// Store New Listing

// Show Form to Edit Listing

// Update Listing

// Delete Listing
