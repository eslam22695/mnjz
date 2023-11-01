<?php


namespace App\Services;


use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    public function __construct(ProductRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
       
        $this->with = [
            'category'
        ];
    }

    public function getProductsWithFilterAndSort($request)
    {
        $product = $this->repository
                        ->when($request->priceFrom, function ($query) use ($request)
                        {
                            $query->where('price', '>=', $request->priceFrom);
                        })
                        ->when($request->priceTo, function ($query) use ($request)
                        {
                            $query->where('price', '<=', $request->priceTo);
                        })
                        ->when($request->category_id, function ($query) use ($request)
                        {
                            $query->where('category_id', $request->category_id);
                        })
                        ->when($request->sortBy, function ($query) use ($request)
                        {
                            $query->orderBy($request->sortBy, $request->sortOrder ?? 'asc');
                        })
                        ->get();
        
        return $product;
    }
}
