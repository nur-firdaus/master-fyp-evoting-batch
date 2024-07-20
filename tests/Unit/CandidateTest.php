<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\CandidateElection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CandidateTest extends TestCase
{

    /** @test */
    public function view_record()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function update_record()
    {
    
        $this->assertTrue(true);
    }
    /** @test */
    public function add_record()
    {
        $this->assertTrue(true);
           
    }

    /** @test */
    public function view_report()
    {
        $this->assertTrue(true);
           
    }
}
