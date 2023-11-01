<?php


namespace App\Services;


use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}
