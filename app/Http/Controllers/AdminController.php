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
}
