<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;

class VoterController extends Controller
{
    /**
     * Store a newly created voter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:voters',
            'password' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:voters',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'is_admin' => 'nullable|boolean'
        ]);

        // Create a new voter instance
        $voter = new Voter();
        $voter->fill($request->all());
        $voter->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Voter created successfully'], 201);
    }

    
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the admin with the provided username
        $admin = Voter::where('username', $request->input('username'))->first();

        // Check if admin exists and the password matches
        if ($admin && ($request->input('password')== $admin->password)) {
            // If authentication is successful, return the admin's details
            return response()->json([
                'id' => $admin->voter_id,
                'username' => $admin->username,
                'email' => $admin->email,
                // Add other admin details as needed
            ], 200);
        }

        // If authentication fails, return an error response
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    
}
