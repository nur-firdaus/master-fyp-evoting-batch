<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateElection extends Model
{
    protected $table = 'candidate_elections';

    protected $fillable = [
        'candidate_id',
        'election_id',
    ];

    // Add any additional relationships or methods here
}
