<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   public function toArray(Request $request): array
{
    return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],

            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'status' => $this->status,

            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => Storage::url($image->image),
                    'is_primary' => $image->is_primary,
                ];
            }),

            'created_at' => $this->created_at,
        ];
    }
}
