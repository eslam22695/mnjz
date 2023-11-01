<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\API\ProductRequest;
use App\Http\Resources\API\ProductResource;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->service->getProductsWithFilterAndSort($request);

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $input = $request->validated();
   
        $product = $this->service->store($input);
   
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $product)
    {
        $input = $request->validated();

        $data = $this->service->update($product, $input);
   
        return $this->sendResponse(new ProductResource($data), 'Product updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $this->service->destroy($product);

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
