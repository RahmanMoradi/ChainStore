<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Shop\StoreShopAction;
use App\Actions\Shop\UpdateShopAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreShopRequest;
use App\Http\Requests\Shop\UpdateShopRequest;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Repositories\Shop\ShopRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Shop::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ShopRepositoryInterface $shopRepository): JsonResponse
    {
        return $this->successResponse(
            ShopResource::collection(
                $shopRepository->paginate($request->input('page_limit'))
            ),
            trans("shop.success_index")
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request): JsonResponse
    {
        $shop = StoreShopAction::run($request->validated());
        return $this->successResponse(
            ShopResource::make($shop),
            trans("shop.success_store")
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop): JsonResponse
    {
        return $this->successResponse(
            ShopResource::make($shop),
            trans("shop.success_show"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop): JsonResponse
    {
        $shop = UpdateShopAction::run($shop, $request->validated());
        return $this->successResponse(
            ShopResource::make($shop),
            trans("shop.success_update"),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop): JsonResponse
    {
        $shop->delete();
        return $this->successResponse(
            "True",
            trans("shop.success_destroy")
        );
    }


}
