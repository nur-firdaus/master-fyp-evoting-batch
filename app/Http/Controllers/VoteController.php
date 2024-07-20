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

    public function getVoteCounts(Request $request)
    {
        $election_id = $request->input('election_id');

        
        // Execute the query
        $results = DB::table('votes')
            ->select(DB::raw('candidate_id, count(voter_id) as vote_count'))
            ->where('election_id', $election_id)
            ->groupBy('candidate_id')
            ->get();

        return response()->json($results);
    }

    public function saveVotes(Request $request)
    {
        // Validate the request
        $request->validate([
            'votes' => 'required|array',
            'votes.*.voter_id' => 'required|integer',
            'votes.*.candidate_id' => 'required|integer',
            'votes.*.election_id' => 'required|integer',
        ]);

        // Iterate over the votes and save each one
        foreach ($request->votes as $voteData) {
            Vote::create([
                'voter_id' => $voteData['voter_id'],
                'candidate_id' => $voteData['candidate_id'],
                'election_id' => $voteData['election_id'],
            ]);
        }
        return response()->json(['message' => 'Votes saved successfully'], 201);
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

    public function checkDoneVote($election_id,$voter_id)
    {
        try {
            // Retrieve voters based on the election ID
            $voters = Vote::where('voter_id', $voter_id)
            ->where('election_id', $election_id)
            ->get();
        

            // Return the list of voters as JSON response
            return response()->json($voters);
        } catch (ModelNotFoundException $exception) {
            // If the election ID is not found, return an error response
            return response()->json(['message' => 'Election not found'], 404);
        }
    }
}


        
