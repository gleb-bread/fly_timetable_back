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

class RegisterController extends Controller
{
    protected $userValidationService;
    protected $responseService;

    /**
     * Конструктор контроллера.
     *
     * @param UserValidationService $userValidationService
     * @param ResponseService $responseService
     */
    public function __construct(UserValidationService $userValidationService, ResponseService $responseService)
    {
        $this->userValidationService = $userValidationService;
        $this->responseService = $responseService;
    }

    /**
     * Регистрация пользователя.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:32',
            'email' => 'required|email',
            'name' => 'nullable|string|max:256',
            'second_name' => 'nullable|string|max:256',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Если валидация не прошла
        if ($validator->fails()) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::VALIDATION_ERRORS,$validator->errors(), 422));
        }

        // Проверка уникальности логина
        if ($this->userValidationService->isLoginTaken($request->login)) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::LOGIN_TAKEN, [], 409)); // 409 Conflict
        }

        // Проверка уникальности email
        if ($this->userValidationService->isEmailTaken($request->email)) {
            return $this->responseService->createResponse(new ResponseData(ResponseMessage::EMAIL_TAKEN, [], 409)); // 409 Conflict
        }

        // Создание нового пользователя
        $user = User::create([
            'login' => $request->login,
            'email' => $request->email, // Сохраняем email
            'name' => $request->name,
            'second_name' => $request->second_name,
            'password' => Hash::make($request->password), // Хэшируем пароль
        ]);

        // Создание токена для пользователя
        $token = $user->createToken('fly_timetable')->plainTextToken;

        // Ответ с успешной регистрацией и токеном
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::USER_REGISTERED, [
            'user' => $user,
            'token' => $token,  // Отправляем токен клиенту
        ], 201));
    }
}
