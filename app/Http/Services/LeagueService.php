<?php

namespace App\Http\Services;

use App\League;
use App\Team;
use Exception;

class LeagueService
{
    /**
     * @return array
     */
    public function get(): array
    {
        try {
            $leagues = League::all();

            return [
                'data' => $leagues,
                'success' => true,
            ];
        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'status_code' => 500,
                'success' => false,
            ];
        }
    }

    /**
     * @param int $teamId
     * @return array
     */
    public function getByTeamId(int $teamId): array
    {
        try {
            $team = Team::find($teamId);

            if (!$team) {
                throw new Exception('El equipo no existe', 400);
            }

            $leagues = $team->league()->get();

            return [
                'data' => $leagues,
                'success' => true,
            ];
        } catch (Exception $exception) {
            return [
                'message' => $exception->getMessage(),
                'status_code' => 500,
                'success' => false,
            ];
        }
    }
}
