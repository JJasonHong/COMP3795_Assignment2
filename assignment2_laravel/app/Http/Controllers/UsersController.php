<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UsersResource::collection(User::all());
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used in an API context
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'registrationDate' => 'required|date',
            'isApproved' => 'required|boolean',
            'role' => 'required|string|max:255'
        ]);

        // Sanitize inputs
        $validated['username'] = strip_tags($validated['username']);
        $validated['firstName'] = strip_tags($validated['firstName']);
        $validated['lastName'] = strip_tags($validated['lastName']);
        $validated['role'] = strip_tags($validated['role']);

        $user = User::create($validated);
        return new UsersResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UsersResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Not used in an API context
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'password' => 'sometimes|string|min:8',
            'registrationDate' => 'required|date',
            'isApproved' => 'required|boolean',
            'role' => 'required|string|max:255'
        ]);

        // Sanitize inputs
        $validated['username'] = strip_tags($validated['username']);
        $validated['firstName'] = strip_tags($validated['firstName']);
        $validated['lastName'] = strip_tags($validated['lastName']);
        $validated['role'] = strip_tags($validated['role']);

        $user->update($validated);
        return [
            'success' => true,
            'user' => new UsersResource($user)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $isSuccess = $user->delete();
        return [
            'success' => $isSuccess
        ];
    }
}
