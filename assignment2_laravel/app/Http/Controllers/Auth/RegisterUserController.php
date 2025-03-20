<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisterUserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate the user
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => ['required','min:8', 'confirmed', Password::defaults()],
        ]);

        // Create the user
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName'  => $request->lastName,
            'username'  => $request->email, // Use username to store the email address
            'password'  => Hash::make($request->password),
        ]);

        // Log the user in
        auth()->login($user);

        // Redirect to the home page
        return redirect('/');
    }
}
