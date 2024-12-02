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
    
            // Если entity = all, создаем записи для всех сущностей
            if ($entityId == array_search('all', $entities)) {
                foreach ($entities as $id => $entityTitle) {
                    if ($entityTitle !== 'all') {
                        $this->addPermission($parsedPermissions, $id, $actionId, $entities, $actions);
                    }
                }
                continue;
            }
    
            // Добавляем действие
            $this->addPermission($parsedPermissions, $entityId, $actionId, $entities, $actions);
        }
    
        // Обработка случаев, когда action = all
        foreach ($parsedPermissions as &$parsedPermission) {
            if (in_array('all', $parsedPermission['actions'])) {
                $parsedPermission['actions'] = array_values(array_diff($actions, ['all']));
            }
        }
    
        // Преобразование результата в массив
        $result = array_values($parsedPermissions);
    
        // Возврат ответа
        return $this->responseService->createResponse(new ResponseData('', $result));
    }
    
    /**
     * Добавление разрешения в массив.
     *
     * @param array $parsedPermissions
     * @param int $entityId
     * @param int $actionId
     * @param array $entities
     * @param array $actions
     */
    private function addPermission(array &$parsedPermissions, int $entityId, int $actionId, array $entities, array $actions)
    {
        if (!isset($parsedPermissions[$entityId])) {
            $parsedPermissions[$entityId] = [
                'entity' => $entities[$entityId] ?? 'Unknown Entity',
                'actions' => [],
            ];
        }
    
        if ($actionId == array_search('all', $actions)) {
            $parsedPermissions[$entityId]['actions'] = array_values(array_diff($actions, ['all']));
        } else {
            $parsedPermissions[$entityId]['actions'][] = $actions[$actionId] ?? 'Unknown Action';
            $parsedPermissions[$entityId]['actions'] = array_unique($parsedPermissions[$entityId]['actions']);
        }
    }
}
 