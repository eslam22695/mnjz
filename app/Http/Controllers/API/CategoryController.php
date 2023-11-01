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
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->service->get();

        return $this->sendResponse($categories, 'Categories retrieved successfully.');
    }

}
