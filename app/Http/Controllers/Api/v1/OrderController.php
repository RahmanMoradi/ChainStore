<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, OrderRepositoryInterface $orderRepository): JsonResponse
    {
        return $this->successResponse(
            OrderResource::collection(
                $orderRepository->paginate($request->input('page_limit'))
            ),
            trans("order.success_index")
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = StoreOrderAction::run($request->validated());
        return $this->successResponse(
            OrderResource::make($order),
            trans("order.success_store")
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): JsonResponse
    {
        return $this->successResponse(
            OrderResource::make($order),
            trans("order.success_show"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $order = UpdateOrderAction::run($order, $request->validated());
        return $this->successResponse(
            OrderResource::make($order),
            trans("order.success_update"),
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();
        return $this->successResponse(
            "True",
            trans("order.success_destroy")
        );
    }

    public function forceDelete(Order $order)
    {
        $order->forceDelete();
        return $this->successResponse(
            "True",
            trans("order.success_force_delete")
        );
    }

    public function restore(Order $order)
    {
        $order->restore();
        return $this->successResponse(
            "True",
            trans("order.success_restore")
        );
    }
}
