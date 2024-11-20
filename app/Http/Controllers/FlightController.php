<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\DTO\ResponseData;
use App\Enums\EntityActions;
use App\Services\ErrorService;

class FlightController extends Controller
{

    protected $responseService;
    protected $userPermissionsService;
    private $_entity = 'flight';

    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        $this->responseService = $responseService;
        $this->userPermissionsService = $userPermissionsService;
        $this->userPermissionsService->main();
    }
    /**
     * Получение списка всех рейсов.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::GET);
        if(!$checkRights) return ErrorService::NotPermission();
        $flights = Flight::all(); // Получение всех рейсов с типами полетов
        return $this->responseService->createResponse(new ResponseData('', $flights));
    }

    /**
     * Создание нового рейса.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
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
