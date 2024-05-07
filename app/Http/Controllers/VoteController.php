<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Vote; 
use App\Models\Voter; 

class VoteController extends Controller
{
    public function saveVote($voter_id, $candidate_id, $election_id)
    {
        // Here you can save the vote to the database
        // For example:
        $vote = new Vote();
        $vote->voter_id = $voter_id;
        $vote->candidate_id = $candidate_id;
        $vote->election_id = $election_id;
        $vote->save();

        // You can return a response indicating success or redirect the user
        return response()->json(['message' => 'Vote saved successfully']);
    }

    public function findVotersBasedOnElectionId($election_id)
    {
        try {
            // Retrieve voters based on the election ID
            $voters = Voter::join('votes', 'voters.voter_id', '=', 'votes.voter_id')
            ->where('votes.election_id', '=', $election_id)
            ->select('voters.*')
            ->get();
        

            // Return the list of voters as JSON response
            return response()->json($voters);
        } catch (ModelNotFoundException $exception) {
            // If the election ID is not found, return an error response
            return response()->json(['message' => 'Election not found'], 404);
        }
    }
}
