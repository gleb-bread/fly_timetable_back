<?php

namespace App\Http\Controllers;

use App\Models\FlightType;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Enums\ResponseMessage;
use App\DTO\ResponseData;

class FlightTypeController extends Controller
{

    protected $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * Получение сущности по ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $flightType = FlightType::all();

        if (!$flightType) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::NOT_FOUND, ['title' => 404], 404));
        }

        return $this->responseService->createResponse(new ResponseData('', $flightType));
    }

    /**
     * Получение сущности по ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        $flightType = FlightType::find($id);

        if (!$flightType) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::NOT_FOUND, ['title' => 404], 404));
        }

        return $this->responseService->createResponse(new ResponseData('', $flightType));
    }

    /**
     * Добавление новой сущности.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $flightType = FlightType::create($validated);

        return response()->json($flightType, 201);
    }
}
