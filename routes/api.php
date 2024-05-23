<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('token', [UserController::class, 'getToken'])->name('user.get_token');

Route::get('leagues', [LeagueController::class, 'get'])->name('league.get');
Route::get('leagues/team/{id}', [LeagueController::class, 'getByTeamId'])->name('league-get_by_team_id');

Route::get('teams/league/{id}', [TeamController::class, 'getByleagueId'])->name('team.get_by_league_id');

Route::get('players/team/{id}', [PlayerController::class, 'getByTeamId'])->name('player.get_by_team_id');
Route::patch('players/{id}', [PlayerController::class, 'update'])->name('player.update');
Route::post('players', [PlayerController::class, 'create'])->name('player.create');
