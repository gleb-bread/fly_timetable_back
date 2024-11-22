<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\DTO\ResponseData;
use App\Enums\ResponseMessage;
use App\Services\UserPermissionsService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    protected $responseService;
    protected $permissionsService;

    public function __construct(ResponseService $responseService, UserPermissionsService $permissionsService)
    {
        $this->responseService = $responseService;
        $this->permissionsService = $permissionsService;
    }

    public function handlerGet(Request $request, ?int $id = null): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
             $this->responseService->createResponse(new ResponseData(ResponseMessage::USER_UNAUTHORIZED, [], 401));
        }

        return $this->responseService->createResponse(new ResponseData('', $user, 200));
    }
}
