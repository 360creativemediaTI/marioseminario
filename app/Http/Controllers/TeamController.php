<?php

namespace App\Http\Controllers;

use App\Http\Services\TeamService;
use Exception;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    private $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * @return JsonResponse
     */
    public function getByLeagueId(int $leagueId): JsonResponse
    {
        try {
            $response = $this->teamService->getByLeagueId($leagueId);

            if (!$response['success']) {
                return new Exception($response['message'], $response['status_code']);
            }

            return response()->json([
                'data' => $response['data'],
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
