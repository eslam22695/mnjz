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
     * @OA\Get(
     *    path="/products",
     *    operationId="index",
     *    tags={"products"},
     *    summary="Get list of products",
     *    description="Get list of products",
     *    @OA\Parameter(name="priceFrom", in="query", description="Price From", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *    @OA\Parameter(name="priceTo", in="query", description="Price To", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *    @OA\Parameter(name="category_id", in="query", description="Category ID", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="sortBy", in="query", description="Define sort by attribute", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *    @OA\Parameter(name="sortOrder", in="query", description="Define sort order  accepts 'asc' or 'desc'", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function index(Request $request)
    {
        $products = $this->service->getProductsWithFilterAndSort($request);

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    /**
     * @OA\Post(
     *    path="/products",
     *    operationId="store",
     *    tags={"products"},
     *    summary="Store product in DB",
     *    description="Store product in DB",
     *    @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "price", "category_id"},
     *            @OA\Property(property="name", type="string", format="string", example="Test Product name"),
     *            @OA\Property(property="price", type="string", format="string", example="1000"),
     *            @OA\Property(property="category_id", type="integer", format="string", example="1"),
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
    public function store(ProductRequest $request)
    {
        $input = $request->validated();
   
        $product = $this->service->store($input);
   
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * @OA\Get(
     *    path="/products/{id}",
     *    operationId="show",
     *    tags={"products"},
     *    summary="Show product details",
     *    description="Show product details",
     *    @OA\Parameter(name="id", in="path", description="Id of product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function show(Product $product)
    {  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    
    }

    /**
     * @OA\Put(
     *    path="/products/{id}",
     *    operationId="update",
     *    tags={"products"},
     *    summary="Update product in DB",
     *    description="Update product in DB",
     *    @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "price", "category_id"},
     *            @OA\Property(property="name", type="string", format="string", example="Test Product name"),
     *            @OA\Property(property="price", type="string", format="string", example="1000"),
     *            @OA\Property(property="category_id", type="integer", format="string", example="1"),
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
    public function update(ProductRequest $request, $product)
    {
        $input = $request->validated();

        $data = $this->service->update($product, $input);
   
        return $this->sendResponse(new ProductResource($data), 'Product updated successfully.');
    
    }

    /**
     * @OA\Delete(
     *    path="/products/{id}",
     *    operationId="destroy",
     *    tags={"products"},
     *    summary="Destroy product",
     *    description="Destroy product",
     *    @OA\Parameter(name="id", in="path", description="Id of product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function destroy($product)
    {
        $this->service->destroy($product);

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
