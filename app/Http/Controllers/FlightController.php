<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\DTO\ResponseData;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Enums\Entity;

class FlightController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::FLIGHT, $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
{
    $flights = QueryBuilder::for(Flight::class)
        ->allowedFilters([
            // Фильтрация по времени отправления
            AllowedFilter::exact('departure_time'),
            // Фильтрация по времени прибытия
            AllowedFilter::exact('arrival_time'),
            // Поиск по полям flight_number, departure_from, destination через q
            AllowedFilter::callback('q', function ($query, $value) {
                $query->where(function ($subQuery) use ($value) {
                    $subQuery->where('flight_number', 'like', "%{$value}%")
                             ->orWhere('departure_from', 'like', "%{$value}%")
                             ->orWhere('destination', 'like', "%{$value}%");
                });
            }),
        ])
        ->limit(100)
        ->get();

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
