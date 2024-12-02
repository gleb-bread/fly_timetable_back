<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\Enums\Entity as EntityEnum;
use App\Models\Entity;
use Illuminate\Http\JsonResponse;
use App\DTO\ResponseData;
use App\Models\Action;

class PermissionController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(EntityEnum::PERMISSION, $responseService, $userPermissionsService);
    }

    public function handlerGetAll(Request $request): JsonResponse
    {
        // Получаем все сущности и действия
        $entities = Entity::all()->pluck('title', 'id')->toArray();
        $actions = Action::all()->pluck('title', 'id')->toArray();

        // Получаем разрешения текущего пользователя
        $permissions = $this->userPermissionsService->getAll();

        // Парсинг разрешений
        $parsedPermissions = [];
        foreach ($permissions as $permission) {
            $entityId = $permission['entity_id'];
            $actionId = $permission['action_id'];

            if (!isset($parsedPermissions[$entityId])) {
                $parsedPermissions[$entityId] = [
                    'entity' => $entities[$entityId] ?? 'Unknown Entity',
                    'actions' => [],
                ];
            }

            $parsedPermissions[$entityId]['actions'][] = $actions[$actionId] ?? 'Unknown Action';
        }

        // Преобразование результата в массив
        $result = array_values($parsedPermissions);

        // Возврат ответа
        return $this->responseService->createResponse(new ResponseData('', $result));
    }


}
 