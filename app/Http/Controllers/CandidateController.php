<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    /**
     * Store a newly created candidate in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:100',
            'position' => 'required|string|max:100'
        ]);

        // Create a new candidate instance
        $candidate = new Candidate();
        $candidate->full_name = $request->input('full_name');
        $candidate->position = $request->input('position');
        $candidate->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Candidate created successfully'], 201);
    }
}
