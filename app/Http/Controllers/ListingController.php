<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function create()
    {
        return view('pages.listings.create');
    }

    // Store New Listing
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    // Show Form to Edit Listing

    // Update Listing

    // Delete Listing

}
