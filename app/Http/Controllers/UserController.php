<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;

class UserController extends Controller
{

    protected $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
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
}
