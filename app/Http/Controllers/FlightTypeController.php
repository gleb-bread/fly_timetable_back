<?php

namespace App\Http\Controllers;

use App\Models\FlightType;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Enums\ResponseMessage;
use App\DTO\ResponseData;
use Illuminate\Http\JsonResponse;
use App\Services\UserPermissionsService;
use App\Enums\Entity;

class FlightTypeController extends Controller
{

    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::FLIGHT_TYPE, $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
    {
        $flightTypes = FlightType::all();

        return $this->responseService->createResponse(new ResponseData('', $flightTypes));
    }

    public function handlerCreate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $flightType = FlightType::create($validated);

        return $this->responseService->createResponse(new ResponseData('', $flightType));
    }

    public function handlerGet(Request $request, int | null $id = null): JsonResponse
    {
        $flightType = FlightType::find($id);

        if (!$flightType) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::NOT_FOUND, ['title' => 404], 404));
        }

        return $this->responseService->createResponse(new ResponseData('', $flightType));
    }
    
}
