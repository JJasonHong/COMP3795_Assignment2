<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // For testing purposes, we're not using any authentication or admin middleware.
    }
    
    /**
     * Display the admin dashboard with user management.
     */
    public function index()
    {
        // Get all users ordered by registration date.
        $users = User::orderBy('registrationDate', 'desc')->get();
        
        return view('admin.dashboard', compact('users'));
    }
    
    /**
     * Update user approval status.
     */
    public function approveUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->isApproved = !$user->isApproved; // Toggle the approval status.
        $user->save();
        
        return back()->with('success', "User {$user->username}'s approval status updated successfully");
    }
    
    /**
     * Update user role.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:Admin,Contributor',
        ]);
        
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        
        return back()->with('success', "User {$user->username}'s role updated to {$request->role}");
    }
    
    /**
     * Delete user account.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $username = $user->username;
        $user->delete();
        
        return back()->with('success', "User {$username} deleted successfully");
    }
}