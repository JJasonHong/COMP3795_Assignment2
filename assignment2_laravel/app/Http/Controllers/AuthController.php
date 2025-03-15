<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UsersResource;

class AuthController extends Controller
{
    public function __construct()
    {
        // Allow login and register without authentication
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        // Validate inputs using username and password
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $request->user()->createToken('Super Safe Token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'user' => new UsersResource($user),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'password'  => 'required|string|min:8'
        ]);

        // Sanitize inputs
        $validated['username'] = strip_tags($validated['username']);
        $validated['firstName'] = strip_tags($validated['firstName']);
        $validated['lastName'] = strip_tags($validated['lastName']);

        // Set auto-generated/default fields
        $validated['registrationDate'] = now();
        $validated['isApproved'] = false;
        $validated['role'] = 'contributor';

        // Hash the password before storing
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Optionally log in the user immediately after registration
        Auth::login($user);

        return response()->json([
            'status'        => 'success',
            'message'       => 'User created successfully',
            'user'          => new UsersResource($user),
            'authorisation' => [
                'token' => $user->createToken('Super Safe Token')->plainTextToken,
                'type'  => 'bearer',
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $token = $user->createToken('Super Safe Token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'user' => new UsersResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function user(Request $request)
    {
        return new UsersResource($request->user());
    }
}
