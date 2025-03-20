<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the user data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,username',
            'password'  => ['required', 'min:8', 'confirmed', Password::defaults()],
        ]);

        // Create the user using the provided first name, last name, and email (stored as username)
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName'  => $request->lastName,
            'username'  => $request->email, // Email stored in the username field
            'password'  => Hash::make($request->password),
        ]);

        // Fire the Registered event and log the user in
        event(new Registered($user));
        Auth::login($user);

        // Redirect to the dashboard
        return redirect('/dashboard');
    }
}