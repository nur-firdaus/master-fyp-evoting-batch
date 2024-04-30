<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote; 

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
}
