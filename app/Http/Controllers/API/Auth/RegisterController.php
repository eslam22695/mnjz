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

    /**
     * @OA\Post(
     *    path="/register",
     *    operationId="register",
     *    tags={"register"},
     *    summary="Store user in DB",
     *    description="Store user in DB",
     *    @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "email", "password", "confirm_password"},
     *            @OA\Property(property="name", type="string", format="string", example="Test User name"),
     *            @OA\Property(property="email", type="email", format="string", example="test@test.test"),
     *            @OA\Property(property="password", type="string", format="string", example="12345678"),
     *            @OA\Property(property="confirm_password", type="string", format="string", example="12345678"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function register(RegisterRequest $request)
    {
        $user =  $this->service->store($request);

        return $this->sendResponse(new UserResource($user), 'User created successfully.');
    }
}
