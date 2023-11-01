<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Resources\API\UserResource;
use App\Services\UserService;

class RegisterController extends BaseController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

    public function register(RegisterRequest $request)
    {
        $user =  $this->service->store($request);

        return $this->sendResponse(new UserResource($user), 'User created successfully.');
    }
}
