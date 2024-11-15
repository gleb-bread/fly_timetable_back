<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserValidationService;  // Импортируем сервис для валидации
use App\Services\ResponseService;       // Импортируем сервис для формирования ответа
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;

class LoginController extends Controller
{
    protected $responseService;

    /**
     * Конструктор контроллера.
     *
     * @param UserValidationService $userValidationService
     * @param ResponseService $responseService
     */
    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * Авторизация пользователя.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Если валидация не прошла
        if ($validator->fails()) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::VALIDATION_ERRORS, $validator->errors(), 422));
        }

        // Поиск пользователя по email
        $user = User::where('email', $request->email)->first();

        // Если пользователь не найден
        if (!$user) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::INVALID_USER_DATA, [], 401)); // 401 Unauthorized
        }

        // Проверка пароля
        if (!Hash::check($request->password, $user->password)) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::INVALID_USER_DATA, [], 401)); // 401 Unauthorized
        }

        // Создание токена для пользователя
        $token = $user->createToken('fly_timetable')->plainTextToken;

        // Ответ с успешной авторизацией и токеном
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::LOGIN_SUCCESS, [
            'user' => $user,
            'token' => $token,  // Отправляем токен клиенту
        ], 200));
    }
}
