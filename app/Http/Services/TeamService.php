<?php

namespace App\Http\Services;

use App\Team;
use Exception;

class TeamService
{
    /**
     * @param $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            $team = Team::find($id);

            return [
                'data' => $team,
                'success' => true,
            ];
        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'success' => false,
                'status_code' => 500
            ];
        }
    }

    /**
     * @return array
     */
    public function getByLeagueId(int $leagueId): array
    {
        try {
            $teams = Team::where('league_id', $leagueId)->get();

            return [
                'data' => $teams,
                'success' => true,
            ];
        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'success' => false,
                'status_code' => 500,
            ];
        }
    }
}
