<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;
use App\Services\UserPermissionsService;

class UserController extends Controller
{

    protected $responseService;
    protected $permissionsService;

    public function __construct(ResponseService $responseService, UserPermissionsService $permissionsService)
    {
        $this->responseService = $responseService;
        $this->permissionsService = $permissionsService;
    }

    /**
     * Получить данные текущего авторизованного пользователя.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserByToken()
    {
        // Получаем текущего авторизованного пользователя
        $user = Auth::user();

        // Проверяем, существует ли пользователь
        if (!$user) {
             $this->responseService->createResponse(new ResponseData(ResponseMessage::USER_UNAUTHORIZED, [], 401));
        }

        // Возвращаем данные пользователя
        return $this->responseService->createResponse(new ResponseData('', $user, 200));
    }

    public function getPermissions(Request $request)
    {
        $token = $request->bearerToken();  // Получаем токен из заголовков запроса

        if (!$token) {
            return response()->json(['error' => 'Token is required'], 401);
        }

        // Получаем вложенный список сущностей с действиями
        $this->permissionsService->main();
        $entitiesWithActions = $this->permissionsService->getPermissions();

        return response()->json($entitiesWithActions);
    }
}
