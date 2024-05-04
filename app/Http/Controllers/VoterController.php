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
}
