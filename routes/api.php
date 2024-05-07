<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\AdminController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//save records
Route::get('/save-vote/{voter_id}/{candidate_id}/{election_id}', [VoteController::class, 'saveVote']);
Route::post('/candidates', [CandidateController::class, 'store']);
Route::post('/voters', [VoterController::class, 'store']);
Route::post('/elections', [ElectionController::class, 'store']);
Route::post('/admins', [AdminController::class, 'store']);

//get listing
Route::get('/elections', [ElectionController::class, 'index']);
Route::get('/elections/{election_id}/candidates', [CandidateController::class, 'findCandidatesBasedOnElectionId']);

//login
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/voter/login', [VoterController::class, 'login']);


//get list of voters
Route::get('/elections/{election_id}/voters', [VoteController::class, 'findVotersBasedOnElectionId']);