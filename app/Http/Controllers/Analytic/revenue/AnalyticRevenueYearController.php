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

class AnalyticRevenueYearController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::ANALYTIC, $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
    {
        $year = $request->input('year', now()->year); // Год или текущий год

        $data = DB::table('applications')
            ->join('flights', 'applications.flight_id', '=', 'flights.id')
            ->selectRaw('MONTH(applications.created_at) as month, SUM(applications.count * flights.price) as total')
            ->whereYear('applications.created_at', $year)
            ->groupByRaw('MONTH(applications.created_at)')
            ->orderBy('month')
            ->get()
            ->map(function ($item) use ($year) {
                $monthName = now()->setYear($year)->setMonth($item->month)->format('F'); // Получаем название месяца
                return [
                    'month' => $item->month,
                    'month_name' => $monthName,
                    'total' => $item->total,
                ];
    });


        $filledData = $this->fillMissingMonths($data, $year);

        return $this->responseService->createResponse(
            new ResponseData('', $filledData)
        );
    }

    /**
     * Заполняет пропущенные месяцы нулевыми значениями.
     *
     * @param \Illuminate\Support\Collection $data
     * @param int $year
     * @return array
     */
    private function fillMissingMonths($data, int $year): array
    {
        // Полный список месяцев года
        $allMonths = collect(range(1, 12))->mapWithKeys(function ($month) use ($year) {
            $monthName = now()->setYear($year)->setMonth($month)->format('F'); // Название месяца
            return [$month => $monthName];
        });

        // Преобразуем входные данные
        $data = $data->mapWithKeys(function ($item) {
            return [$item['month'] => $item['total']];
        });

        // Заполнение пропущенных месяцев
        $result = $allMonths->mapWithKeys(function ($monthName, $month) use ($data) {
            return [$month => [
                'title' => $monthName,
                'total' => (float)$data->get($month, 0),
            ]];
        });

        return $result->values()->toArray();
    }
}
