<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Cart;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\Enums\Entity;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(Entity::CART, $responseService, $userPermissionsService);
    }

    /**
     * Создание записи в корзине.
     */
    public function handlerCreate(Request $request): JsonResponse
    {

        $userId = $this->_user->id;

        $validated = $request->validate([
            'flight_id' => 'required|integer|exists:flights,id',
            'count' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = $userId;

        $cart = Cart::create($validated);

        return $this->responseService->createResponse(
            new ResponseData('', $cart)
        );
    }

    /**
     * Получение записи корзины по ID.
     */
    public function handlerGet(Request $request, int $id = null): JsonResponse
    {
        $cart = Cart::with('flight')->find($id);

        if (!$cart) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, [], 404)
            );
        }

        return $this->responseService->createResponse(
            new ResponseData('', $cart)
        );
    }

    /**
     * Обновление записи корзины.
     */
    public function handlerUpdate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:carts,id',
            'count' => 'required|integer|min:1',
        ]);

        $cart = Cart::find($validated['id']);

        if (!$cart) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, [], 404)
            );
        }

        $cart->update(['count' => $validated['count']]);

        return $this->responseService->createResponse(
            new ResponseData('', $cart)
        );
    }

    /**
     * Удаление записи из корзины.
     */
    public function handlerDelete(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:carts,id',
        ]);

        $cart = Cart::find($validated['id']);

        if (!$cart) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, ['result' => 404], 404)
            );
        }

        $cart->delete();

        return $this->responseService->createResponse(
            new ResponseData('', true)
        );
    }

    /**
     * Получение всех записей корзины для пользователя.
     */
    public function handlerGetAll(Request $request): JsonResponse
    {
        $userId = $this->_user->id;

        $carts = Cart::where('user_id', $userId)->with('flight')->get();

        return $this->responseService->createResponse(
            new ResponseData('', $carts)
        );
    }
}
