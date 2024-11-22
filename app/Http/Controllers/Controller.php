<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\Enums\EntityActions;
use App\Services\ErrorService;
use Illuminate\Http\Request;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;

abstract class Controller
{
    private string $_entity;
    protected UserPermissionsService $userPermissionsService;
    protected ResponseService $responseService;
 

    public function __construct(string $entity, ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        $this->userPermissionsService = $userPermissionsService;
        $this->responseService = $responseService;
        $this->_entity = $entity;
        $this->userPermissionsService->main();
    }

    public function get(Request $request): JsonResponse{
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::GET);
        if(!$checkRights) return ErrorService::NotPermission();

        return $this->handlerGet($request);
    }

    public function getAll(Request $request){
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::GET_ALL);
        if(!$checkRights) return ErrorService::NotPermission();
        
        return $this->handlerGetAll($request);
    }

    public function create(Request $request){
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::CREATE);
        if(!$checkRights) return ErrorService::NotPermission();
        
        return $this->handlerCreate($request);
    }

    public function buy(Request $request){
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::BUY);
        if(!$checkRights) return ErrorService::NotPermission();
        
        return $this->handlerBuy($request);
    }

    public function delete(Request $request){
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::DELETE);
        if(!$checkRights) return ErrorService::NotPermission();
        
        return $this->handlerDelete($request);
    }

    public function update(Request $request){
        $checkRights = $this->userPermissionsService->checkAction($this->_entity, EntityActions::UPDATE);
        if(!$checkRights) return ErrorService::NotPermission();
        
        return $this->handlerUpdate($request);
    }

    public function handlerCreate(Request $request): JsonResponse{
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::METHOD_NOT_FOUND, [], 404));
    }

    public function handlerBuy(Request $request): JsonResponse{
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::METHOD_NOT_FOUND, [], 404));
    }

    public function handlerGet(Request $request, int | null $id = null): JsonResponse{
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::METHOD_NOT_FOUND, [], 404));
    }

    public function handlerUpdate(Request $request): JsonResponse{
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::METHOD_NOT_FOUND, [], 404));
    }

    public function handlerDelete(Request $request): JsonResponse{
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::METHOD_NOT_FOUND, [], 404));
    }

    public function handlerGetAll(Request $request): JsonResponse{
        return $this->responseService->createResponse(new ResponseData(ResponseMessage::METHOD_NOT_FOUND, [], 404));
    }
}
