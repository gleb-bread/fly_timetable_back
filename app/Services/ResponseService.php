<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\DTO\ResponseData;

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
    public function createResponse(ResponseData $data): JsonResponse
    {
        // Стандартная структура ответа
        $response = [
            'message' => $data->message,
            'data' => $data->data,
        ];

        // Возвращаем JSON-ответ с указанным статусом
        return response()->json($response, $data->status);
    }
}
