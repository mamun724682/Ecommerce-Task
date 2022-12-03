<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    /**
     * Order List
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->success(
            'Order List.',
            OrderResource::collection($this->orderService->get(null, ['user', 'orderItems']))
        );
    }

    /**
     * Store order
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        return response()->success(
            'Order placed successfully.',
            new OrderResource($this->orderService->storeOrder($request->validated())),
            Response::HTTP_CREATED
        );
    }
}
