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
        # show all listings with filters & pagination
        return view('pages.listings.index', [
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show Single Listing
    public function show(Listing $listing)
    {
        # show a single listing
        return view('pages.listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Form to Create New Listing
    public function create()
    {
        # show create form
        return view('pages.listings.create');
    }

    // Store New Listing
    public function store(Request $request)
    {
        # validating the form fields
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        # uploading the file
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        # inserting the listing & redirect with a message
        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Form to Edit Listing
    public function edit(Listing $listing)
    {
        # show edit form
        return view('pages.listings.edit', ['listing' => $listing]);
    }

    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        # validating the form fields
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        # uploading the file
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        # updating the listing & return with a message
        $listing->update($formFields);
        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function delete(Listing $listing)
    {
        # deleting the listing & redirect with a message
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
