<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // All Listings
    public function index()
    {
        return view('pages.listings.index', [
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    // Show Single Listing
    public function show(Listing $listing)
    {
        return view('pages.listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Form to Create New Listing

    // Store New Listing

    // Show Form to Edit Listing

    // Update Listing

    // Delete Listing

}
