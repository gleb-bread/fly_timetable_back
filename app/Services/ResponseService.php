<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ResponseService
{
    /**
     * Формирует стандартный JSON-ответ.
     *
     * @param string $message Сообщение для ответа
     * @param mixed $data Данные, которые нужно отправить в ответе (объект или массив)
     * @param int $status HTTP статус код (по умолчанию 200)
     * @return JsonResponse
     */
    public function createResponse(string $message = '', $data = null, int $status = 200): JsonResponse
    {
        // Стандартная структура ответа
        $response = [
            'message' => $message,
            'data' => $data,
        ];

        // Возвращаем JSON-ответ с указанным статусом
        return response()->json($response, $status);
    }
}
