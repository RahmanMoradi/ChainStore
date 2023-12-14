<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Product\StoreProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Product::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductRepositoryInterface $productRepository): JsonResponse
    {
        return $this->successResponse(
            ProductResource::collection(
                $productRepository->paginate($request->input('page_limit'))
            ),
            trans("product.success_index")
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = StoreProductAction::run($request->validated());
        return $this->successResponse(
            ProductResource::make($product),
            trans("product.success_store")
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return $this->successResponse(
            ProductResource::make($product),
            trans("product.success_show"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product = UpdateProductAction::run($product, $request->validated());
        return $this->successResponse(
            ProductResource::make($product),
            trans("product.success_update"),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->successResponse(
            "True",
            trans("product.success_destroy")
        );
    }

}
