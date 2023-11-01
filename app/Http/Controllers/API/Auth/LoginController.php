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

    /**
     * @OA\Post(
     *    path="/login",
     *    operationId="login",
     *    tags={"login"},
     *    summary="Get auth user",
     *    description="Get auth user",
     *    @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"email", "password"},
     *            @OA\Property(property="email", type="email", format="string", example="test@test.test"),
     *            @OA\Property(property="password", type="string", format="string", example="12345678"),
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
