<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartQuantityRequest;
use App\Http\Requests\CartRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->success(
            'Cart List.',
            $this->getCartDetails()
        );
    }

    public function addToCart(CartRequest $request)
    {
        Product::addToCart($request->product_id, $request->quantity ?? 1);
        return response()->success(
            'Product added to cart.',
            $this->getCartDetails()
        );
    }

    /**
     * Increment cart item quantity.
     *
     * @return JsonResponse
     */
    public function cartItemQuantitySet(CartQuantityRequest $request, $cartItemIndex)
    {
        cart()->setQuantityAt($cartItemIndex, $request->quantity);

        return response()->success(
            'Cart quantity updated.',
            $this->getCartDetails()
        );
    }

    /**
     * Increment cart item quantity.
     *
     * @return JsonResponse
     */
    public function incrementCartItem($cartItemIndex)
    {
        cart()->incrementQuantityAt($cartItemIndex);

        return response()->success(
            'Cart updated.',
            $this->getCartDetails()
        );
    }

    /**
     * Decrement cart item quantity.
     *
     * @return JsonResponse
     */
    public function decrementCartItem($cartItemIndex)
    {
        cart()->decrementQuantityAt($cartItemIndex);

        return response()->success(
            'Cart updated.',
            $this->getCartDetails()
        );
    }

    /**
     * Remove from cart.
     *
     * @return JsonResponse
     */
    public function removeFromCart($cartItemIndex)
    {

        cart()->removeAt($cartItemIndex);

        return response()->success(
            'Product removed from cart.',
            $this->getCartDetails()
        );
    }

    /**
     * Remove from cart.
     *
     * @return JsonResponse
     */
    public function clearCart()
    {

        cart()->clear();

        return response()->success(
            'Cart cleared.',
            $this->getCartDetails()
        );
    }

    /**
     * @return array
     */
    private function getCartDetails(): array
    {
        return [
            'items' => cart()->items(),
            'totals' => cart()->totals(),
        ];
    }
}
