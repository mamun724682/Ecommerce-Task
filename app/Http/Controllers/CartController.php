<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartQuantityRequest;
use App\Http\Requests\CartRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    /**
     * Cart items list
     *
     * @return JsonResponse
     */
    public function cartItems(): JsonResponse
    {
        return response()->success(
            'Cart Items.',
            $this->cartService->getCartItems()
        );
    }

    /**
     * Add item to cart
     *
     * @param CartRequest $request
     * @return JsonResponse
     */
    public function addToCart(CartRequest $request): JsonResponse
    {
        return response()->success(
            'Product added to cart.',
            $this->cartService->addToCart($request->validated())
        );
    }

    /**
     * Set cart item quantity.
     *
     * @param CartQuantityRequest $request
     * @param $cartItemIndex
     * @return JsonResponse
     */
    public function cartItemQuantitySet(CartQuantityRequest $request, $cartItemIndex): JsonResponse
    {
        return response()->success(
            'Cart quantity updated.',
            $this->cartService->cartItemQuantitySet($cartItemIndex, $request->quantity)
        );
    }

    /**
     * Increment cart item quantity.
     *
     * @param $cartItemIndex
     * @return JsonResponse
     */
    public function incrementCartItem($cartItemIndex): JsonResponse
    {
        return response()->success(
            'Cart updated.',
            $this->cartService->incrementCartItem($cartItemIndex)
        );
    }

    /**
     * Decrement cart item quantity.
     *
     * @param $cartItemIndex
     * @return JsonResponse
     */
    public function decrementCartItem($cartItemIndex): JsonResponse
    {
        return response()->success(
            'Cart updated.',
            $this->cartService->decrementCartItem($cartItemIndex)
        );
    }

    /**
     * Remove from cart.
     *
     * @param $cartItemIndex
     * @return JsonResponse
     */
    public function removeFromCart($cartItemIndex): JsonResponse
    {
        return response()->success(
            'Product removed from cart.',
            $this->cartService->removeFromCart($cartItemIndex)
        );
    }

    /**
     * Clear items from cart.
     *
     * @return JsonResponse
     */
    public function clearCart(): JsonResponse
    {
        return response()->success(
            'Cart cleared.',
            $this->cartService->clearCart()
        );
    }
}
