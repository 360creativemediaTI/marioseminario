<?php

namespace App\Http\Controllers;

use App\Http\Services\PlayerService;
use App\Player;
use Exception;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    private $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * @param int $teamId
     * @return JsonResponse
     */
    public function getByTeamId(int $teamId)
    {
        try {
            $response = $this->playerService->getByTeamId($teamId);

            if (!$response['success']) {
                throw new Exception($response['message'], $response['status_code']);
            }

            return response()->json([
                'data' => $response['data'],
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500  );
        }
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        try {
            $response = $this->playerService->getById($id);

            if (!$response['success']) {
                throw new Exception($response['message'], $response['status_code']);
            }

            $player = $response['data'];

            $player->update($request->only('team_id'));

            return response()->json([
                'data' => $player,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $player = Player::create($request->only('name', 'team_id'));

            return response()->json([
                'data' => $player,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
