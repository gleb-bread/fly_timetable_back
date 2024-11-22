<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\DTO\ResponseData;
use Illuminate\Http\JsonResponse;

class FlightController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct('flight', $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
    {
        $flights = Flight::all();
        return $this->responseService->createResponse(new ResponseData('', $flights));
    }

    public function handlerCreate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'flight_type_id' => 'required|exists:flight_types,id',
            'departure_from' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'flight_number' => 'required|string|max:50',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        $flight = Flight::create($validated);

        return $this->responseService->createResponse(new ResponseData('', $flight));
    }
}
