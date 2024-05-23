<?php

namespace App\Http\Services;

use App\Player;
use Exception;

class PlayerService
{
    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            $player = Player::find($id);

            if (!$player) {
                throw new Exception('El jugador no existe', 400);
            }

            return [
                'data' => $player,
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
            $players = Player::where('team_id', $teamId)->get();

            return [
                'data' => $players,
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
