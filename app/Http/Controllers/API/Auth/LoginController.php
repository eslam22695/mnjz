<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\LoginRequest;
use App\Http\Resources\API\UserResource;
use App\Services\UserService;
use Exception;

class LoginController extends BaseController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

    public function login(LoginRequest $request)
    {
        try {
            $user =  $this->service->login($request);

            return $this->sendResponse(new UserResource($user), 'User login successfully.');

        } catch (Exception $exception) {
            return $this->sendError('Wrong Credintial.', $exception->getMessage());
        }
    }
}
