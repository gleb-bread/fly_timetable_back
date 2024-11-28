<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Cart;
use App\Models\Application;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;
use App\Enums\Entity;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::APPLICATION, $responseService, $userPermissionsService);
    }

    /**
     * Создание Application из записей в корзине.
     */
    public function handlerCreate(Request $request): JsonResponse
    {
        $userId = Auth::id(); // ID текущего пользователя

        // Получаем все записи из таблицы Cart для текущего пользователя
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, [], 404)
            );
        }

        // Получаем последний order_id для текущего пользователя в таблице Application
        $lastOrder = Application::where('user_id', $userId)
            ->orderBy('order_id', 'desc')
            ->first();

        $orderId = $lastOrder ? $lastOrder->order_id + 1 : 1;

        // Добавляем записи в таблицу Application с новым order_id
        $applications = [];
        foreach ($cartItems as $cartItem) {
            $applications[] = [
                'user_id' => $userId,
                'flight_id' => $cartItem->flight_id,
                'count' => $cartItem->count,
                'order_id' => $orderId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Application::insert($applications);

        // Удаляем записи из таблицы Cart
        Cart::where('user_id', $userId)->delete();

        // Получаем все заявки текущего пользователя с подгруженными сущностями flight
        $applications = Application::with('flight')
            ->where('user_id', $userId)
            ->where('order_id', $orderId)
            ->get();

        return $this->responseService->createResponse(
            new ResponseData('', $applications)
        );
    }

    /**
     * Получение всех заявок, сгруппированных по order_id, включая сущность flight.
     */
    public function handlerGetAll(Request $request): JsonResponse
    {
        $userId = Auth::id();

        // Получаем все заявки текущего пользователя с подгруженными сущностями flight
        $applications = Application::with('flight')
            ->where('user_id', $userId)
            ->get();

        if ($applications->isEmpty()) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, [], 404)
            );
        }

        // Группируем записи по полю order_id
        $groupedApplications = $applications->groupBy('order_id');

        return $this->responseService->createResponse(
            new ResponseData('', $groupedApplications->toArray())
        );
    }



    /**
     * Получение одной заявки.
     */
    public function handlerGet(Request $request, ?int $id = null): JsonResponse
    {
        $userId = Auth::id();

        $application = Application::where('user_id', $userId)->find($id);

        if (!$application) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, [], 404)
            );
        }

        return $this->responseService->createResponse(
            new ResponseData('', $application->toArray())
        );
    }

    /**
     * Обновление заявки.
     */
    public function handlerUpdate(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $id = intval($request['id']);

        $application = Application::where('user_id', $userId)->find($id);

        if (!$application) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, [], 404)
            );
        }

        $validatedData = $request->validate([
            'flight_id' => 'sometimes|integer',
            'count' => 'sometimes|integer|min:1',
        ]);

        $application->update($validatedData);

        return $this->responseService->createResponse(
            new ResponseData('', $application->toArray())
        );
    }
}
