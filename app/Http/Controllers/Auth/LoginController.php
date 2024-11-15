<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserValidationService;  // Импортируем сервис для валидации
use App\Services\ResponseService;       // Импортируем сервис для формирования ответа
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            return $this->responseService->createResponse($validator->errors(), 422);
        }

        // Поиск пользователя по email
        $user = User::where('email', $request->email)->first();

        // Если пользователь не найден
        if (!$user) {
            return $this->responseService->createResponse('The provided credentials are incorrect.', 401); // 401 Unauthorized
        }

        // Проверка пароля
        if (!Hash::check($request->password, $user->password)) {
            return $this->responseService->createResponse('The provided credentials are incorrect.', 401); // 401 Unauthorized
        }

        // Создание токена для пользователя
        $token = $user->createToken('fly_timetable')->plainTextToken;

        // Ответ с успешной авторизацией и токеном
        return $this->responseService->createResponse('User logged in successfully!', [
            'user' => $user,
            'token' => $token,  // Отправляем токен клиенту
        ], 200);
    }
}
