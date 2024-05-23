<?php

namespace App\Http\Controllers;

use App\Http\Services\LeagueService;
use App\Http\Services\TeamService;
use App\Team;
use Exception;
use Illuminate\Http\JsonResponse;

class LeagueController extends Controller
{
    private $leagueService;
    private $teamService;

    public function __construct(LeagueService $leagueService, TeamService $teamService)
    {
        $this->leagueService = $leagueService;
        $this->teamService = $teamService;
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        try {
            $response = $this->leagueService->get();

            if (!$response['success']) {
                return new Exception($response['message'], $response['status_code']);
            }

            return response()->json([
                'data' => $response['data'],
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * @param int $teamId
     * @return JsonResponse
     */
    public function getByTeamId(int $teamId)
    {
        try {
            $response = $this->teamService->getById($teamId);

            if (!$response['success']) {
                return new Exception($response['message'], $response['status_code']);
            }

            $team = $response['data'];

            $response = $team->league()->get();

            return response()->json([
                'data' => $response,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
}
