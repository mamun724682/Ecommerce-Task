<?php

namespace App\Services;

use App\Models\OrderItem;

class OrderItemService extends BaseService
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $order_id
     * @param array $cart_items
     * @return bool
     */
    public function insertOrderCartItems(int $order_id, array $cart_items): bool
    {
        $items = [];
        foreach ($cart_items as $cart_item) {
            $item = [
                'order_id'   => $order_id,
                'product_id' => $cart_item['modelId'],
                'name'       => $cart_item['name'],
                'price'      => $cart_item['price'],
                'quantity'   => $cart_item['quantity'],
            ];

            $items[] = $item;
        }

        return $this->model::insert($items);
    }
}
