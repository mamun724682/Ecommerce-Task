<?php

namespace App\Services;

use App\Exceptions\OrderEmptyCartException;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    private $cartService;
    private $orderItemService;

    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->cartService = app(CartService::class);
        $this->orderItemService = app(OrderItemService::class);
    }

    /**
     * @param array $data
     * @return Order
     * @throws \Throwable
     */
    public function storeOrder(array $data): Order
    {
        try {
            DB::beginTransaction();
            // Get Cart
            $cart = $this->cartService->getCartItems();

            // If cart is empty
            throw_if($cart['payable'] == 0, new OrderEmptyCartException());

            // Store order
            $order_data = $cart + $data + ['user_id' => auth()->id(), 'status' => $this->model::STATUS_PROCESSING];
            $order = $this->storeOrUpdate($order_data);

            // Store order items
            $this->orderItemService->insertOrderCartItems($order->id, $cart['items']);

            // Clear cart
            $this->cartService->clearCart();

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logErrorResponse($e);
        }
    }
}
