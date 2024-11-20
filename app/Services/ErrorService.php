<?php

namespace App\Services;

use App\DTO\ResponseData;
use App\Enums\ResponseMessage;

class ErrorService
{
    /**
     * Статический метод для возврата ошибки "User Not Found"
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function UserNotFound(): \Illuminate\Http\JsonResponse
    {
        // Создаем экземпляр ResponseData с нужными параметрами
        $responseData = new ResponseData(
            ResponseMessage::USER_UNAUTHORIZED, // Сообщение из Enum
            null, // Данные пустые
            400   // HTTP статус 400
        );

        // Используем ResponseService для создания ответа
        return (new ResponseService())->createResponse($responseData);
    }

    public static function AdminEntityNotFound(): \Illuminate\Http\JsonResponse
    {
        // Создаем экземпляр ResponseData с нужными параметрами
        $responseData = new ResponseData(
            ResponseMessage::ADMIN_ENTITY_NOT_FOUND, // Сообщение из Enum
            null, // Данные пустые
            500   // HTTP статус 400
        );

        // Используем ResponseService для создания ответа
        return (new ResponseService())->createResponse($responseData);
    }

    public static function AdminActionNotFound(): \Illuminate\Http\JsonResponse
    {
        // Создаем экземпляр ResponseData с нужными параметрами
        $responseData = new ResponseData(
            ResponseMessage::ADMIN_ACTION_NOT_FOUND, // Сообщение из Enum
            null, // Данные пустые
            500   // HTTP статус 400
        );

        // Используем ResponseService для создания ответа
        return (new ResponseService())->createResponse($responseData);
    }

    public static function EntityNotFound(): \Illuminate\Http\JsonResponse
    {
        // Создаем экземпляр ResponseData с нужными параметрами
        $responseData = new ResponseData(
            ResponseMessage::ENTITY_NOT_FOUND, // Сообщение из Enum
            null, // Данные пустые
            500   // HTTP статус 400
        );

        // Используем ResponseService для создания ответа
        return (new ResponseService())->createResponse($responseData);
    }

    public static function ActionNotFound(): \Illuminate\Http\JsonResponse
    {
        // Создаем экземпляр ResponseData с нужными параметрами
        $responseData = new ResponseData(
            ResponseMessage::ACTION_NOT_FOUND, // Сообщение из Enum
            null, // Данные пустые
            500   // HTTP статус 400
        );

        // Используем ResponseService для создания ответа
        return (new ResponseService())->createResponse($responseData);
    }

    public static function  NotPermission(): \Illuminate\Http\JsonResponse
    {
        // Создаем экземпляр ResponseData с нужными параметрами
        $responseData = new ResponseData(
            ResponseMessage::NOT_PERMISSION, // Сообщение из Enum
            null, // Данные пустые
            403   // HTTP статус 400
        );

        // Используем ResponseService для создания ответа
        return (new ResponseService())->createResponse($responseData);
    }
}
