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

class AnalyticRevenueMounthController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::ANALYTIC, $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
    {
        $month = $request->input('month', now()->format('Y-m')); // Год и месяц или текущий месяц

        $data = DB::table('applications')
            ->join('flights', 'applications.flight_id', '=', 'flights.id') // Соединяем с таблицей flights
            ->selectRaw('WEEK(applications.created_at, 1) as week, SUM(applications.count * flights.price) as total') // Считаем сумму
            ->whereRaw("DATE_FORMAT(applications.created_at, '%Y-%m') = ?", [$month])
            ->groupByRaw('WEEK(applications.created_at, 1)')
            ->orderBy('week')
            ->get()
            ->map(function ($item) {
                return [
                    'week' => $item->week,
                    'total' => $item->total,
                ];
            });

        $filledData = $this->fillMissingWeeks($data, $month);

        return $this->responseService->createResponse(
            new ResponseData('', $filledData)
        );
    }

    /**
     * Заполняет пропущенные недели нулевыми значениями.
     *
     * @param \Illuminate\Support\Collection $data
     * @param string $month
     * @return array
     */
    private function fillMissingWeeks($data, string $month): array
    {
        // Вычисляем все недели месяца
        $startOfMonth = now()->parse($month . '-01')->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $weeks = collect();

        // Генерация всех недель месяца
        for ($date = $startOfMonth; $date <= $endOfMonth; $date->addWeek()) {
            $weeks->push($date->isoWeek()); // Получаем ISO-недели
        }

        // Преобразуем входные данные
        $data = $data->mapWithKeys(function ($item) {
            return [$item['week'] => $item['total']];
        });

        // Заполнение пропущенных недель
        $result = $weeks->mapWithKeys(function ($week) use ($data) {
            return [$week => $data->get($week, 0)];
        });

        // Формируем итоговый массив
        return $result->map(function ($total, $week) {
            return [
                'title' => $week, // Номер недели
                'total' => (float)$total,
            ];
        })->values()->toArray();
    }
}
