<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Store a newly created admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins',
            'password' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:admins'
        ]);

        // Create a new admin instance
        $admin = new Admin();
        $admin->fill($request->all());
        $admin->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Admin created successfully'], 201);
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the admin with the provided username
        $admin = Admin::where('username', $request->input('username'))->first();

        // Check if admin exists and the password matches
        if ($admin && ($request->input('password')== $admin->password)) {
            // If authentication is successful, return the admin's details
            return response()->json([
                'id' => $admin->admin_id,
                'username' => $admin->username,
                'email' => $admin->email,
                // Add other admin details as needed
            ], 200);
        }

        // If authentication fails, return an error response
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
