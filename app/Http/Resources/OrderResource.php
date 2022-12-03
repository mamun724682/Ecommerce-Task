<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"                 => $this->id,
            "subtotal"           => $this->subtotal,
            "discount"           => $this->discount,
            "discountPercentage" => $this->discountPercentage,
            "shippingCharges"    => $this->shippingCharges,
            "netTotal"           => $this->netTotal,
            "tax"                => $this->tax,
            "total"              => $this->total,
            "roundOff"           => $this->roundOff,
            "payable"            => $this->payable,
            "shipping_address"   => $this->shipping_address,
            "status"             => $this->status,
            "updated_at"         => $this->updated_at,
            "created_at"         => $this->created_at,
            "user"               => new UserResource($this->whenLoaded('user')),
            "orderItems"         => OrderItemResource::collection($this->whenLoaded('orderItems')),
        ];
    }
}
