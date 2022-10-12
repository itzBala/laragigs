<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Form to Create/Register User
    public function create()
    {
        # show create form
        return view('pages.users.create');
    }

    // Store New User 
    public function store(Request $request)
    {
        # validating the form fields
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        # hashing the password
        $formFields['password'] = bcrypt($formFields['password']);

        # inserting the user
        $user = User::create($formFields);

        # login & redirect with a message
        auth()->login($user);
        return redirect('/')->with('message', 'User created & Logged in!');
    }

    // Form to User Login
    public function login()
    {
        # show login form
        return view('pages.users.login');
    }

    // Login User
    public function authenticate(Request $request)
    {
        # validating the form fields
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        # attempt for login
        if (auth()->attempt($formFields)) {
            #regenerate session & redirect with a message
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        # if attempt failed, return with errors
        return back()->withErrors(['email' => 'Invalid Credentials!'])->onlyInput('email');
    }

    // Log User Out
    public function logout(Request $request)
    {
        # logout
        auth()->logout();

        # invalidating & regenerating the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        # redirect with a message
        return redirect('/')->with('message', 'You have been logged out!');
    }
}
