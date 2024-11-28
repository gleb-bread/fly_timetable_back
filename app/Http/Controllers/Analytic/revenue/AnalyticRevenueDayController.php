<?php

namespace App\Http\Controllers\Analytic\revenue;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;
use App\Enums\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnalyticRevenueDayController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::ANALYTIC, $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
    {
        $date = $request->input('date', now()->toDateString()); // Дата или текущий день

        $data = DB::table('applications')
            ->join('flights', 'applications.flight_id', '=', 'flights.id') // Соединяем с таблицей flights
            ->selectRaw('HOUR(applications.created_at) as hour, SUM(applications.count * flights.price) as total') // Считаем сумму
            ->whereDate('applications.created_at', $date)
            ->groupByRaw('HOUR(applications.created_at)')
            ->orderBy('hour')
            ->get()
            ->map(function ($item) {
                return [
                    'hour' => $item->hour,
                    'total' => $item->total,
                ];
            });

        $filledData = $this->fillMissingHours($data);

        return $this->responseService->createResponse(
            new ResponseData('', $filledData)
        );
    }


    /**
     * Генерирует массив с часами от 00:00 до 23:00 с total 0
     * и заполняет данные, если они есть.
     *
     * @param \Illuminate\Support\Collection $data
     * @return array
     */
    private function fillMissingHours($data): array
    {
        $hours = collect(range(0, 23))->mapWithKeys(function ($hour) {
            return [str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00' => 0];
        });

        $data = $data->mapWithKeys(function ($item) {
            $hour = str_pad($item['hour'], 2, '0', STR_PAD_LEFT) . ':00';
            return [$hour => $item['total']];
        });

        // Объединение данных
        $result = $hours->merge($data)->map(function ($total, $hour) {
            return [
                'title' => $hour,
                'total' => (float)$total,
            ];
        });

        return $result->values()->toArray();
    }
}
