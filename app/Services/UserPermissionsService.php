<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\RoleUserAssigment;
use App\Services\ErrorService;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Enums\EntityActions;
use App\Models\Entity;
use App\Models\Action;
use App\Enums\Entity as EntityEnum;
use Illuminate\Http\JsonResponse;

class UserPermissionsService
{

    private Authenticatable $_user;
    /**
     * Получить вложенный список сущностей с действиями по токену пользователя
     * 
     * @param string $token
     * @return array
     */

    public function main(){
        $user = Auth::user();

        if(!isset($user)) return ErrorService::UserNotFound();

        $this->_user = $user;
        
        return $this;
    }

    public function checkAction(EntityEnum $entity, EntityActions $action){
        $permissions = collect($this->getPermissions());

        if($this->checkAdmin($permissions)) return true;

        $enityModel = $this->getEntity($entity);

        if($enityModel instanceof JsonResponse){
            return $enityModel;
        }

        $actionModel = $this->getAction($action);

        if($actionModel instanceof JsonResponse){
            return $actionModel;
        }

        $result = $permissions->where('entity_id', $enityModel->id)->where('action_id', $actionModel->id);

        if($result->isEmpty()){
            return false;
        } else {
            return true;
        }
    }


    private function checkAdmin(\Illuminate\Support\Collection $permissions){
        $action = $this->getAdminAction();

        if($action instanceof JsonResponse){
            return $action;
        }

        $entity = $this->getAdminEntity();
        
        if($entity instanceof JsonResponse){
            return $entity;
        }

        $entity = $permissions->where('entity_id', $entity->id)->where('action_id', $action->id);

        if($entity->isEmpty()){
            return false;
        } else {
            return true;
        }
    }

    private function getAdminEntity(): Entity|JsonResponse {
        $entities = Entity::where('title', 'all')->get(); 
        if ($entities->isEmpty()) {
            return ErrorService::AdminEntityNotFound(); // Предположим, что ErrorService возвращает JsonResponse
        }
        return $entities->first(); // Возвращаем первый объект из коллекции
    }
    
    private function getAdminAction(): Action|JsonResponse {
        $entities = Action::where('title', 'all')->get(); 
        if ($entities->isEmpty()) {
            return ErrorService::AdminActionNotFound(); // Предположим, что ErrorService возвращает JsonResponse
        }
        return $entities->first(); // Возвращаем первый объект из коллекции
    }

    private function getEntity(EntityEnum $entity): Entity|JsonResponse {
        $entities = Entity::where('title', $entity)->get(); 
        if ($entities->isEmpty()) {
            return ErrorService::EntityNotFound(); // Предположим, что ErrorService возвращает JsonResponse
        }
        return $entities->first(); // Возвращаем первый объект из коллекции
    }

    private function getAction(EntityActions $action): Action|JsonResponse {
        $entities = Action::where('title', $action)->get(); 
        if ($entities->isEmpty()) {
            return ErrorService::ActionNotFound(); // Предположим, что ErrorService возвращает JsonResponse
        }
        return $entities->first(); // Возвращаем первый объект из коллекции
    }

    public function getPermissions(){
        $rolePermissions = $this->getRolePermissions();
        $permissions = [];
        
        foreach($rolePermissions as $rolePermission){
            array_push($permissions, $rolePermission->permission);
        }

        return $permissions;
    }

    private function getRolePermissions(){
        $roles = $this->getRoles();
        $permissions = [];
        
        foreach($roles as $role){
            foreach($role->rolePermissions as $permission){
                array_push($permissions, $permission);
            }
        }

        return $permissions;
    }

    public function getRoles(){
        $roleUserAssigments = $this->getRoleAssigments();
        $roles = [];

        foreach($roleUserAssigments as $roleUserAssigment){
            array_push($roles, $roleUserAssigment->role);
        }

        return $roles;
    }

    private function getRoleAssigments(){
        return $this->_user->roleUserAssigment;
    }

    public function getEntitiesWithActionsByToken(string $token)
    {
        // Получаем пользователя через токен
        $user = Auth::user();
        $assignments = $user->assignments;
        $roleUserAssigment = RoleUserAssigment::whereBelongsTo($assignments)->get();
        return $roleUserAssigment;
        // Получаем все роли, связанные с пользователем
        $roles = $user->roles; 

        return $roles;

        $entitiesWithActions = [];

        // Проходим по всем ролям пользователя
        foreach ($roles as $role) {
            // Получаем все разрешения (permissions) для роли
            $permissions = $role->permissions;

            // Проходим по разрешениям и группируем их по сущности
            foreach ($permissions as $permission) {
                // Получаем сущность (например, User, Project и т. д.)
                $entity = $permission->entity;

                // Получаем действия для сущности (например, create, edit, delete)
                $action = $permission->action;

                // Добавляем сущность с действиями в итоговый список
                if (!isset($entitiesWithActions[$entity])) {
                    $entitiesWithActions[$entity] = [];
                }

                $entitiesWithActions[$entity][] = $action;
            }
        }

        return $entitiesWithActions;
    }

    
    
}
