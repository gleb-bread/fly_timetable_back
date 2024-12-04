<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Services\UserPermissionsService;
use App\Enums\Entity as EntityEnum;
use Illuminate\Http\JsonResponse;
use App\DTO\ResponseData;
use App\Models\Project;
use App\Models\UserAssigment;
use App\Enums\Project as ProjectEnum;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;

class UserIsStuffController extends Controller
{
    public function __construct(ResponseService $responseService, UserPermissionsService $userPermissionsService)
    {
        parent::__construct(EntityEnum::USER, $responseService, $userPermissionsService);
    }

    public function handlerGet(Request $request, ?int $id = null): JsonResponse
    {
        $project = Project::whereHas('projectType', function ($query) {
            $query->where('title', ProjectEnum::STUFF);
        })->first();

        if (!$project) {
            return $this->responseService->createResponse(
                new ResponseData(ResponseMessage::NOT_FOUND, null, 404)
            );
        }

        $assigment = UserAssigment::where(['user_id' => $this->_user->id, 'project_id' => $project->id])->first();

        $result = boolval($assigment);

        return $this->responseService->createResponse(new ResponseData('', $result));
    }
}
 