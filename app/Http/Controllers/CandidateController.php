<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\CandidateElection;

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

    
    public function findCandidatesBasedOnElectionId($election_id)
    {
        try {
            // Retrieve voters based on the election ID
            $candidates = Candidate::join('candidate_elections', 'candidates.candidate_id', '=', 'candidate_elections.candidate_id')
            ->where('candidate_elections.election_id', '=', $election_id)
            ->get();
        

            // Return the list of voters as JSON response
            return response()->json($candidates);
        } catch (ModelNotFoundException $exception) {
            // If the election ID is not found, return an error response
            return response()->json(['message' => 'Election not found'], 404);
        }
    }
}
