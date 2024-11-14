<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
            'login' => 'required|string|max:32|unique:users,login',
            'name' => 'nullable|string|max:256',
            'second_name' => 'nullable|string|max:256',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Если валидация не прошла
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Создание нового пользователя
        $user = User::create([
            'login' => $request->login,
            'name' => $request->name,
            'second_name' => $request->second_name,
            'password' => Hash::make($request->password), // Хэшируем пароль
        ]);

        // Ответ с успешной регистрацией
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
        ], 201);
    }
}
