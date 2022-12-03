<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    /**
     * All cart item list
     * @return array
     */
    public function getCartItems(): array
    {
        return cart()->toArray();
    }

    /**
     * Add item to cart
     * @param $data
     * @return array
     */
    public function addToCart($data): array
    {
        return Product::addToCart($data['product_id'], $data['quantity'] ?? 1);
    }

    /**
     * Set cart item quantity
     * @param $cartItemIndex
     * @param $quantity
     * @return array
     */
    public function cartItemQuantitySet($cartItemIndex, $quantity): array
    {
        return cart()->setQuantityAt($cartItemIndex, $quantity);
    }

    /**
     * Increment cart item
     * @param $cartItemIndex
     * @return array
     */
    public function incrementCartItem($cartItemIndex): array
    {
        return cart()->incrementQuantityAt($cartItemIndex);
    }

    /**
     * Decrement cart item
     * @param $cartItemIndex
     * @return array
     */
    public function decrementCartItem($cartItemIndex): array
    {
        return cart()->decrementQuantityAt($cartItemIndex);
    }

    /**
     * Remove item from cart
     * @param $cartItemIndex
     * @return array
     */
    public function removeFromCart($cartItemIndex): array
    {
        return cart()->removeAt($cartItemIndex);
    }

    /**
     * Clear full cart
     * @return array
     */
    public function clearCart(): array
    {
        cart()->clear();
        return $this->getCartItems();
    }
}
