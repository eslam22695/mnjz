<?php


namespace App\Http\Controllers;

use App\Services\IService;


/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Mnjz Api Documentation",
 *     description="Mnjz Api Documentation",
 *     @OA\Contact(
 *         name="Eslam Osama",
 *         email="eslamosama22695@gmail.com"
 *     )
 * ),
 * @OA\Server(
 *     url="/api/",
 * ),
 */

class BaseController extends Controller
{

    /**
     * @var IService
     */
    protected $service;

    public function __construct(IService $service)
    {
        $this->service = $service;
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}