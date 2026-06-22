<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'subtotal' => $this->subtotal,

            'discount' => $this->discount,

            'tax' => $this->tax,

            'shipping_charge' => $this->shipping_charge,

            'grand_total' => $this->grand_total,

            'items' => $this->items->map(function ($item) {

                return [

                    'id' => $item->id,

                    'product_id' => $item->product_id,

                    'product_name' => $item->product->name,

                    'quantity' => $item->quantity,

                    'price' => $item->price,

                    'total' => $item->total,
                ];
            }),
        ];
    }
}