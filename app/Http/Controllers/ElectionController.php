<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;

class ElectionController extends Controller
{
    /**
     * Store a newly created election in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'nullable|boolean'
        ]);

        // Create a new election instance
        $election = new Election();
        $election->fill($request->all());
        $election->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Election created successfully'], 201);
    }
}

