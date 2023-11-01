<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Services\CategoryService;

class CategoryController extends BaseController
{
    
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }

    /**
     * @OA\Get(
     *    path="/category",
     *    operationId="Category index",
     *    tags={"category"},
     *    summary="Get list of categories",
     *    description="Get list of categories",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function index()
    {
        $categories = $this->service->get();

        return $this->sendResponse($categories, 'Categories retrieved successfully.');
    }

}
